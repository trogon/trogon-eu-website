// assets/tools/resistance.tsx
"use strict";

import jQuery from "jquery";

import React, { Component } from "react";
import { createRoot } from "react-dom/client";

import Col from "react-bootstrap/Col";
import Row from "react-bootstrap/Row";

import Form from "react-bootstrap/Form";
import InputGroup from "react-bootstrap/InputGroup";

import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faPencil } from "@fortawesome/free-solid-svg-icons";

interface IpAddressState {
  userIpAddress: string;
  userMaskIpAddress: string;
  userMaskPrefixLength: string;

  ipv4Network: Ipv4Network;
}

class Ipv4Address {
  private converter: Ipv4AddressConverter;
  private ipBytes: number;
  private ipString: string;

  constructor(ipNumber: number) {
    this.converter = new Ipv4AddressConverter();
    this.ipBytes = ipNumber;
    this.ipString = this.getStringAddress();
  }

  isValid(): boolean {
    return Number.isFinite(this.ipBytes);
  }

  isValidMaskAddress(): boolean {
    return this.isValid();
  }

  getNumberAddress(): number {
    return this.ipBytes;
  }

  getInvertNumberAddress(): number {
    return this.converter.invertAddressNumber(this.ipBytes);
  }

  getStringAddress(): string {
    if (!this.isValid()) {
      return "";
    }

    return this.converter.convertNumberToString(this.ipBytes);
  }
}

class Ipv4Network {
  private networkAddress: Ipv4Address;
  private networkMask: Ipv4Address;
  private networkBroadcast: Ipv4Address;

  constructor(address: Ipv4Address, mask: Ipv4Address) {
    this.networkAddress = new Ipv4Address(Number.NaN);
    this.networkMask = new Ipv4Address(Number.NaN);
    this.networkBroadcast = new Ipv4Address(Number.NaN);

    if (mask.isValidMaskAddress()) {
      this.networkMask = new Ipv4Address(mask.getNumberAddress());
      if (address.isValid()) {
        this.networkAddress = new Ipv4Address(
          address.getNumberAddress() & mask.getNumberAddress()
        );
        this.networkBroadcast = new Ipv4Address(
          (address.getNumberAddress() & mask.getNumberAddress()) |
            mask.getInvertNumberAddress()
        );
      }
    }
  }

  isValid(): boolean {
    return (
      this.networkAddress.isValid() && this.networkMask.isValidMaskAddress()
    );
  }

  getNetworkAddress(): Ipv4Address {
    return this.networkAddress;
  }

  getNetworkMask(): Ipv4Address {
    return this.networkMask;
  }

  getNetworkBroadcast(): Ipv4Address {
    return this.networkBroadcast;
  }

  getFirstHostAddress(): Ipv4Address {
    if (this.networkAddress.isValid()) {
      const networkNumber = this.networkAddress.getNumberAddress();
      const broadcastNumber = this.networkBroadcast.getNumberAddress();
      const firstHostNumber = networkNumber + 1;

      if (
        firstHostNumber !== broadcastNumber &&
        networkNumber !== broadcastNumber
      ) {
        return new Ipv4Address(firstHostNumber);
      }
    }

    return new Ipv4Address(Number.NaN);
  }

  getLastHostAddress(): Ipv4Address {
    if (this.networkBroadcast.isValid()) {
      const networkNumber = this.networkAddress.getNumberAddress();
      const broadcastNumber = this.networkBroadcast.getNumberAddress();
      const lastHostNumber = broadcastNumber - 1;

      // TODO: Handle mask 31 and 32 prefix
      if (
        lastHostNumber !== networkNumber &&
        networkNumber !== broadcastNumber
      ) {
        return new Ipv4Address(lastHostNumber);
      }
    }

    return new Ipv4Address(Number.NaN);
  }
}

class Ipv4AddressConverter {
  getMaskAddress(prefixLength: number): string {
    let ipAddress: number[] = [];
    let buffer = 0;

    for (let index = 0; index < 32; index++, prefixLength--) {
      // Add one bit if prefix is positive
      if (prefixLength > 0) {
        buffer |= 1;
      }

      // Add buffer to address when processed all bites of segment
      if (index % 8 == 7) {
        ipAddress = [...ipAddress, buffer];
        buffer = 0;
      }

      // Shift the buffer for next bit.
      buffer = buffer << 1;
    }

    return ipAddress.join(".");
  }

  convertStringToAddress(ipv4Address: string): Ipv4Address {
    const ipNumber = this.convertStringToNumber(ipv4Address);

    return new Ipv4Address(ipNumber);
  }

  convertStringToNumber(ipv4Address: string): number {
    const nSegments = this.getIpv4StringSegments(ipv4Address, ".");
    let ipNumber = 0;

    if (nSegments.length !== 4) {
      return Number.NaN;
    }

    for (let index = 0; index < nSegments.length; index++) {
      const element = nSegments[index];
      ipNumber = ipNumber << 8;
      ipNumber = ipNumber + element;
    }

    return ipNumber;
  }

  convertNumberToAddress(ipv4Number: number): Ipv4Address {
    return new Ipv4Address(ipv4Number);
  }

  convertNumberToString(ipv4Number: number): string {
    const segmentMask = 255;
    let ipAddress: number[] = [];
    let buffer = ipv4Number;

    if (!Number.isFinite(ipv4Number)) {
      return "";
    }

    for (let index = 0; index < 4; index++) {
      const nSegment = buffer & segmentMask;
      buffer = buffer >> 8;
      ipAddress = [nSegment, ...ipAddress];
    }

    return ipAddress.join(".");
  }

  getIpv4StringSegments(ipv4Address: string, separator: string): number[] {
    const segments = ipv4Address.split(separator);

    // Check if address has value in all segments
    const shortestString = segments.reduce((prevValue, currValue) => {
      if (prevValue.length < currValue.length) return prevValue;
      else return currValue;
    });
    if (shortestString.length === 0) {
      console.log("Found zero length segment");
      return [];
    }

    // Check if all segments contain numbers
    const nSegments = segments.map((x) => Number(x));
    const firstInvalidNumber = nSegments.reduce((prevValue, currValue) => {
      if (!Number.isFinite(prevValue) || prevValue < 0) return prevValue;
      if (!Number.isFinite(currValue) || currValue < 0) return currValue;
      else return currValue;
    });
    if (!Number.isFinite(firstInvalidNumber) || firstInvalidNumber < 0) {
      console.log("Found segment with not finite number");
      return [];
    }

    return nSegments;
  }

  invertAddressNumber(ipNumber: number): number {
    return -1 ^ ipNumber;
  }
}

class IpAddressTool extends Component {
  state: IpAddressState = {
    userIpAddress: "",
    userMaskIpAddress: "",
    userMaskPrefixLength: "",
    ipv4Network: new Ipv4Network(
      new Ipv4Address(Number.NaN),
      new Ipv4Address(Number.NaN)
    ),
  };

  constructor(props: any) {
    super(props);

    // This binding is necessary to make `this` work in the callback
    this.handleIpAddressChange = this.handleIpAddressChange.bind(this);
    this.handleMaskIpAddressChange = this.handleMaskIpAddressChange.bind(this);
    this.handleMaskPrefixLengthChange =
      this.handleMaskPrefixLengthChange.bind(this);

    this.updateResults = this.updateResults.bind(this);
  }

  handleIpAddressChange(newUserIpAddress: string): void {
    this.updateResults({
      ...this.state,
      userIpAddress: newUserIpAddress,
    });
  }

  handleMaskIpAddressChange(newUserMaskIpAddress: string): void {
    const maskPrefixLength = "";

    this.updateResults({
      ...this.state,
      userMaskIpAddress: newUserMaskIpAddress,
      userMaskPrefixLength: maskPrefixLength,
    });
  }

  handleMaskPrefixLengthChange(newUserMaskPrefixLength: string): void {
    const prefixLength = Number(newUserMaskPrefixLength);
    if (
      typeof prefixLength === "number" &&
      Number.isFinite(prefixLength) &&
      prefixLength >= 0 &&
      prefixLength <= 32
    ) {
      const converter = new Ipv4AddressConverter();
      const maskIpAddress = converter.getMaskAddress(prefixLength);

      this.updateResults({
        ...this.state,
        userMaskIpAddress: maskIpAddress,
        userMaskPrefixLength: newUserMaskPrefixLength,
      });
    } else {
      this.updateResults({
        ...this.state,
        userMaskPrefixLength: newUserMaskPrefixLength,
      });
    }
  }

  updateResults(newParameters: IpAddressState): void {
    const converter = new Ipv4AddressConverter();
    const maskAddress = converter.convertStringToAddress(
      newParameters.userMaskIpAddress
    );
    const userAddress = converter.convertStringToAddress(
      newParameters.userIpAddress
    );
    const network = new Ipv4Network(userAddress, maskAddress);

    this.setState({
      ...newParameters,
      ipv4Network: network,
    });
  }

  render() {
    return (
      <div className="card-body">
        <Form>
          <Row className="mb-3">
            <Col>
              <Form.Group controlId="formUserIpAddress">
                <Form.Label>Some IP Address</Form.Label>
                <InputGroup>
                  <InputGroup.Text>
                    <FontAwesomeIcon icon={faPencil} />
                  </InputGroup.Text>
                  <Form.Control
                    type="text"
                    placeholder="Enter IP Address"
                    value={this.state.userIpAddress}
                    onChange={(e) => this.handleIpAddressChange(e.target.value)}
                  />
                </InputGroup>
                <Form.Text className="text-muted">
                  Type any valid IP address from your network.
                </Form.Text>
              </Form.Group>
            </Col>

            <Col>
              <Form.Group controlId="formMaskAddress">
                <Form.Label>Mask IP Address</Form.Label>
                <InputGroup>
                  <InputGroup.Text>
                    <FontAwesomeIcon icon={faPencil} />
                  </InputGroup.Text>
                  <Form.Control
                    type="text"
                    placeholder="Enter mask IP Address"
                    value={this.state.userMaskIpAddress}
                    onChange={(e) =>
                      this.handleMaskIpAddressChange(e.target.value)
                    }
                  />
                </InputGroup>
                <Form.Text className="text-muted">
                  Type mask IP address for network or as a prefix length.
                </Form.Text>
              </Form.Group>
            </Col>

            <Col>
              <Form.Group controlId="formMaskPrefixLength">
                <Form.Label>Mask prefix</Form.Label>
                <InputGroup>
                  <InputGroup.Text>
                    <FontAwesomeIcon icon={faPencil} />
                  </InputGroup.Text>
                  <Form.Control
                    type="text"
                    placeholder="Enter mask prefix length"
                    value={this.state.userMaskPrefixLength}
                    onChange={(e) =>
                      this.handleMaskPrefixLengthChange(e.target.value)
                    }
                  />
                </InputGroup>
                <Form.Text className="text-muted">
                  Length of mask prefix in number of bits. Value between 0-32.
                </Form.Text>
              </Form.Group>
            </Col>
          </Row>

          <Row className="mb-3">
            <Col>
              <Form.Group controlId="formNetworkIpAddress">
                <Form.Label>Network IP Address</Form.Label>
                <Form.Control
                  type="text"
                  placeholder="Computed network IP Address"
                  readOnly
                  value={this.state.ipv4Network
                    .getNetworkAddress()
                    .getStringAddress()}
                />
                <Form.Text className="text-muted">
                  IP Address that identifies the network. It is used for routing
                  purposes.
                </Form.Text>
              </Form.Group>
            </Col>

            <Col>
              <Form.Group controlId="formBroadcastIpAddress">
                <Form.Label>Broadcast IP Address</Form.Label>
                <Form.Control
                  type="text"
                  placeholder="Computed broadcast IP Address"
                  readOnly
                  value={this.state.ipv4Network
                    .getNetworkBroadcast()
                    .getStringAddress()}
                />
                <Form.Text className="text-muted">
                  Broadcast IP address used for sending data too all devices in
                  the network.
                </Form.Text>
              </Form.Group>
            </Col>
          </Row>

          <Row className="mb-3">
            <Col>
              <Form.Group controlId="formFirstHostIpAddress">
                <Form.Label>First host IP Address</Form.Label>
                <Form.Control
                  type="text"
                  placeholder="Computed first available host IP Address"
                  readOnly
                  value={this.state.ipv4Network
                    .getFirstHostAddress()
                    .getStringAddress()}
                />
              </Form.Group>
            </Col>

            <Col>
              <Form.Group controlId="formLastHostIpAddress">
                <Form.Label>Last host IP Address</Form.Label>
                <Form.Control
                  type="text"
                  placeholder="Computed last available host IP Address"
                  readOnly
                  value={this.state.ipv4Network
                    .getLastHostAddress()
                    .getStringAddress()}
                />
              </Form.Group>
            </Col>
          </Row>
        </Form>
      </div>
    );
  }
}

jQuery(function () {
  let toolDomContainer = document.querySelector("#tool");

  const root = createRoot(toolDomContainer!);
  root.render(<IpAddressTool />);
});
