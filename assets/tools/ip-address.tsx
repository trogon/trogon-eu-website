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
}

interface Ipv4Address {
  displaySize: number;
  pixelDensity: number;
  pixelQuantity: number;
  resolutionHeight: number;
  resolutionWidth: number;
  userDisplaySize: string;
  userPixelDensity: string;
  userPixelQuantity: string;
  userResolutionHeight: string;
  userResolutionWidth: string;
}

class IpAddressTool extends Component {
  state: IpAddressState = {
    userIpAddress: "",
    userMaskIpAddress: "",
    userMaskPrefixLength: "",
    //   ipv4NetworkAddress: 0,
    //   ipv4BroadcastAddress: 0,
    //   ipv4MaskAddress: 0,
    //   ipv4MaskPrefixLength: 0,
    //   ipv4FirstAddress: 0,
    //   ipv4LastAddress: "",
  };

  constructor(props: any) {
    super(props);

    // // This binding is necessary to make `this` work in the callback
    // this.computeDensity = this.computeDensity.bind(this);
    // this.computeQuantity = this.computeQuantity.bind(this);

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
      const maskIpAddress = this.getMaskAddress(prefixLength);

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
      buffer <<= 1;
    }

    return ipAddress.join(".");
  }

  updateResults(newParameters: IpAddressState): void {
    this.setState({
      ...newParameters,
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
                />
                <Form.Text className="text-muted">
                  IP Address that identifies the network. It is used for routing purposes.
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
                />
                <Form.Text className="text-muted">
                  Broadcast IP address used for sending data too all devices in the network.
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
