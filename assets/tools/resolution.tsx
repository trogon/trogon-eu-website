// assets/tools/resistance.tsx
"use strict";

import jQuery from "jquery";

import React, { Component } from "react";
import { createRoot } from "react-dom/client";

import Col from "react-bootstrap/Col";
import Row from "react-bootstrap/Row";

import Form from "react-bootstrap/Form";
import InputGroup from "react-bootstrap/InputGroup";

interface Resolution {
  name: string;
  width: number;
  height: number;
  ratio?: string;
  unit?: string;
}

interface ResolutionDensityState {
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

const commonResolutions: Resolution[] = [
  { name: "720p (HD)", width: 1280, height: 720 },
  { name: "900p (HD Plus)", width: 1600, height: 900 },
  { name: "1080p (Full HD)", width: 1920, height: 1080 },
  { name: "1440p (Quad HD)", width: 2560, height: 1440 },
  { name: "2160p (4K UHD)", width: 3840, height: 2160 },
  { name: "4320p (8K UHD)", width: 7680, height: 4320 },
];

class ResolutionTool extends Component {
  state: ResolutionDensityState = {
    displaySize: 0,
    pixelDensity: 0,
    pixelQuantity: 0,
    resolutionHeight: 0,
    resolutionWidth: 0,
    userDisplaySize: "",
    userPixelDensity: "",
    userPixelQuantity: "",
    userResolutionHeight: "",
    userResolutionWidth: "",
  };

  constructor(props: any) {
    super(props);

    // This binding is necessary to make `this` work in the callback
    this.computeDensity = this.computeDensity.bind(this);
    this.computeQuantity = this.computeQuantity.bind(this);

    this.handleResolutionSelectionChange =
      this.handleResolutionSelectionChange.bind(this);
    this.handleResolutionWidthChange =
      this.handleResolutionWidthChange.bind(this);
    this.handleResolutionHeightChange =
      this.handleResolutionHeightChange.bind(this);
    this.handleDisplaySizeChange = this.handleDisplaySizeChange.bind(this);

    this.updateResults = this.updateResults.bind(this);
  }

  handleResolutionSelectionChange(
    newSelectedResolution: number,
    resolutions: Resolution[]
  ): void {
    let index = Number(newSelectedResolution);
    if (
      typeof index === "number" &&
      Number.isFinite(index) &&
      index >= 0 &&
      index < resolutions.length
    ) {
      const selectedResolution = resolutions[index];
      this.updateResults({
        ...this.state,
        resolutionWidth: selectedResolution.width,
        userResolutionWidth: selectedResolution.width.toString(),
        resolutionHeight: selectedResolution.height,
        userResolutionHeight: selectedResolution.height.toString(),
      });
    } else {
      this.updateResults({
        ...this.state,
      });
    }
  }

  handleResolutionWidthChange(newResolutionWidth: string): void {
    let width = Number(newResolutionWidth);
    if (typeof width === "number" && Number.isFinite(width)) {
      this.updateResults({
        ...this.state,
        resolutionWidth: width,
        userResolutionWidth: newResolutionWidth,
      });
    } else {
      this.updateResults({
        ...this.state,
        resolutionWidth: 0,
        userResolutionWidth: newResolutionWidth,
      });
    }
  }

  handleResolutionHeightChange(newResolutionHeight: string): void {
    let height = Number(newResolutionHeight);
    if (typeof height === "number" && Number.isFinite(height)) {
      this.updateResults({
        ...this.state,
        resolutionHeight: height,
        userResolutionHeight: newResolutionHeight,
      });
    } else {
      this.updateResults({
        ...this.state,
        resolutionHeight: 0,
        userResolutionHeight: newResolutionHeight,
      });
    }
  }

  handleDisplaySizeChange(newDisplaySize: string): void {
    let size = Number(newDisplaySize);
    if (typeof size === "number" && Number.isFinite(size)) {
      this.updateResults({
        ...this.state,
        displaySize: size,
        userDisplaySize: newDisplaySize,
      });
    } else {
      this.updateResults({
        ...this.state,
        displaySize: 0,
        userDisplaySize: newDisplaySize,
      });
    }
  }

  computeDensity(newParameters: ResolutionDensityState): number {
    let newDensity = 0;

    const width2 =
      newParameters.resolutionHeight * newParameters.resolutionHeight;
    const height2 =
      newParameters.resolutionWidth * newParameters.resolutionWidth;
    const pixelSum = width2 + height2;

    if (pixelSum > 0 && newParameters.displaySize > 0) {
      const pxDiagonal = Math.sqrt(pixelSum);
      newDensity = pxDiagonal / newParameters.displaySize;
    }

    return newDensity;
  }

  computeQuantity(newParameters: ResolutionDensityState): number {
    const newQuantity =
      newParameters.resolutionHeight * newParameters.resolutionWidth;

    console.log(newQuantity);

    if (newQuantity > 0) {
      return newQuantity;
    }

    return 0;
  }

  updateResults(newParameters: ResolutionDensityState): void {
    const newDensity = this.computeDensity(newParameters);
    const newQuantity = this.computeQuantity(newParameters);

    this.setState({
      ...newParameters,
      pixelDensity: newDensity,
      userPixelDensity: newDensity > 0 ? newDensity.toLocaleString() : "",
      pixelQuantity: newQuantity,
      userPixelQuantity: newQuantity > 0 ? newQuantity.toLocaleString() : "",
    });
  }

  render() {
    return (
      <div className="card-body">
        <Form>
          <Row className="mb-3">
            <Col>
              <Form.Group controlId="formCommonResolution">
                <Form.Label>Common resolutions</Form.Label>
                <Form.Select
                  onChange={(e) =>
                    this.handleResolutionSelectionChange(
                      e.target.selectedIndex,
                      commonResolutions
                    )
                  }
                >
                  {commonResolutions.map((resolution, i) => (
                    <option
                      key={`resolution-${i}`}
                    >{`${resolution.name} (${resolution.width}×${resolution.height}px)`}</option>
                  ))}
                </Form.Select>
                <Form.Text className="text-muted">
                  You can select one of common resolutions available or enter
                  your resolution in two fields below instead.
                </Form.Text>
              </Form.Group>
            </Col>

            <Col>
              <Form.Group controlId="formDisplaySize">
                <Form.Label>Display size</Form.Label>
                <InputGroup>
                  <Form.Control
                    type="text"
                    placeholder="Enter dispaly size"
                    value={this.state.userDisplaySize}
                    onChange={(e) =>
                      this.handleDisplaySizeChange(e.target.value)
                    }
                  />
                  <InputGroup.Text>inch</InputGroup.Text>
                </InputGroup>
                <Form.Text className="text-muted">
                  Defined as diagonal length in inches.
                </Form.Text>
              </Form.Group>
            </Col>
          </Row>

          <Row className="mb-3">
            <Col>
              <Form.Group controlId="formResolutionWidth">
                <Form.Label>Resolution width</Form.Label>
                <InputGroup>
                  <Form.Control
                    type="text"
                    placeholder="Enter resolution width"
                    value={this.state.userResolutionWidth}
                    onChange={(e) =>
                      this.handleResolutionWidthChange(e.target.value)
                    }
                  />
                  <InputGroup.Text>px</InputGroup.Text>
                </InputGroup>
                <Form.Text className="text-muted">
                  Resolution width as number of pixels.
                </Form.Text>
              </Form.Group>
            </Col>

            <Col>
              <Form.Group controlId="formResolutionHeight">
                <Form.Label>Resolution height</Form.Label>
                <InputGroup>
                  <Form.Control
                    type="text"
                    placeholder="Enter resolution height"
                    value={this.state.userResolutionHeight}
                    onChange={(e) =>
                      this.handleResolutionHeightChange(e.target.value)
                    }
                  />
                  <InputGroup.Text>px</InputGroup.Text>
                </InputGroup>
                <Form.Text className="text-muted">
                  Resolution height as number of pixels.
                </Form.Text>
              </Form.Group>
            </Col>
          </Row>

          <Row className="mb-3">
            <Col>
              <Form.Group controlId="formQuantity">
                <Form.Label>Pixel quantity</Form.Label>
                <Form.Control
                  type="text"
                  placeholder="Total pixel quantity"
                  readOnly
                  value={this.state.userPixelQuantity}
                />
              </Form.Group>
            </Col>

            <Col>
              <Form.Group controlId="formDensity">
                <Form.Label>Pixel density</Form.Label>
                <InputGroup>
                  <Form.Control
                    aria-label="Dollar amount (with dot and two decimal places)"
                    type="text"
                    placeholder="Pixel density"
                    readOnly
                    value={this.state.userPixelDensity}
                  />
                  <InputGroup.Text>pixels/inch</InputGroup.Text>
                </InputGroup>
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
  root.render(<ResolutionTool />);
});
