// assets/tools/hash.tsx
"use strict";

import "./styles/resistance.scss";

import jQuery from "jquery";

import React, { Component } from "react";
import { createRoot } from "react-dom/client";

import Alert from "react-bootstrap/Alert";
import Button from "react-bootstrap/Button";
import Form from "react-bootstrap/Form";
import Tab from "react-bootstrap/Tab";
import Tabs from "react-bootstrap/Tabs";
import ToggleButton from "react-bootstrap/ToggleButton";
import ToggleButtonGroup from "react-bootstrap/ToggleButtonGroup";

var CryptoJS = require("crypto-js");

const algorithmsList = ["Base64", "MD5", "SHA256", "SHA512"];
const directionsList = ["Encode", "Decode"];

interface IOptionSelectorProps {
  inputName: string;
  defaultValue: number | string;
  options: string[];
  onChange?: (value: number) => void;
}

interface IOptionSelectorState {
  selectedOption: string | undefined;
  selectedIndex: number;
  defaultValue: number | string;
  inputName: string;
  options: string[];
  onChange?: (value: number) => void;
}

interface IAlgorithmState {
  inputValue: string | undefined;
  selectedDirection: number;
  selectedAlgorithm: number;
  computedValue: string | undefined;
}

class OptionSelector extends Component<IOptionSelectorProps> {
  state: IOptionSelectorState;

  constructor(props: IOptionSelectorProps) {
    super(props);
    this.state = {
      selectedOption: undefined,
      selectedIndex: 0,
      defaultValue: props.defaultValue,
      inputName: props.inputName || "option-selector",
      options: props.options || [],
      onChange: props.onChange,
    };

    // This binding is necessary to make `this` work in the callback
    this.handleAlgorithmChange = this.handleAlgorithmChange.bind(this);
  }

  getComputerIndex(naturalIndex: number): number {
    return naturalIndex - 1;
  }

  getKey(index: number): string {
    return `${this.state.inputName}-${index}`;
  }

  getNaturalIndex(computerIndex: number): number {
    return computerIndex + 1;
  }

  handleAlgorithmChange(value: number): void {
    // Update state for new draw
    this.setState({
      ...this.state,
      selectedIndex: value,
      selectedOption: this.state.options[this.getComputerIndex(value)],
    });

    // Inform external Component
    if (this.state.onChange) {
      this.state.onChange(value);
    }
  }

  render() {
    return (
      <div>
        <ToggleButtonGroup
          type="radio"
          className="me-1"
          name={this.state.inputName}
          defaultValue={this.state.defaultValue}
          onChange={(value, _) => this.handleAlgorithmChange(value)}
        >
          {this.state.options.map((radioOption, i) => (
            <ToggleButton
              key={this.getKey(i)}
              id={this.getKey(i)}
              value={this.getNaturalIndex(i)}
            >
              {radioOption}
            </ToggleButton>
          ))}
        </ToggleButtonGroup>
      </div>
    );
  }
}

class HashCalculatorTool extends Component {
  state: IAlgorithmState;

  constructor(props: any) {
    super(props);
    this.state = {
      inputValue: undefined,
      selectedDirection: 1,
      selectedAlgorithm: 1,
      computedValue: undefined,
    };

    // This binding is necessary to make `this` work in the callback
    this.handleInputUpdate = this.handleInputUpdate.bind(this);
    this.handleDirectionUpdate = this.handleDirectionUpdate.bind(this);
    this.handleAlgorithmUpdate = this.handleAlgorithmUpdate.bind(this);
    this.computeHash = this.computeHash.bind(this);
  }

  handleInputUpdate(value: string): void {
    this.computeHash({ ...this.state, inputValue: value });
  }
  handleDirectionUpdate(value: number): void {
    this.computeHash({ ...this.state, selectedDirection: value });
  }
  handleAlgorithmUpdate(value: number): void {
    this.computeHash({ ...this.state, selectedAlgorithm: value });
  }

  computeHash(newState: IAlgorithmState): void {
    let computedValue: string = `${newState.inputValue}, ${newState.selectedDirection}, ${newState.selectedAlgorithm}`;

    try {
      switch (newState.selectedAlgorithm) {
        case 1:
          if (newState.selectedDirection == 1) {
            // Encode
            const input = CryptoJS.enc.Utf8.parse(newState.inputValue);
            computedValue = CryptoJS.enc.Base64.stringify(input);
          } else {
            // Decode
            computedValue = CryptoJS.enc.Base64.parse(
              newState.inputValue
            ).toString(CryptoJS.enc.Utf8);
          }
          break;
        case 2:
          computedValue = CryptoJS.MD5(newState.inputValue);
          break;
        case 3:
          computedValue = CryptoJS.SHA256(newState.inputValue);
          break;
        case 4:
          computedValue = CryptoJS.SHA512(newState.inputValue);
          break;
      }
    } catch (e) {
      console.log(e);
      computedValue = "Unable to process. Please contact support.";
    }

    this.setState({ ...newState, computedValue: computedValue });
  }

  render() {
    return (
      <div>
        <Alert key={"info"} variant={"info"}>
          Disclaimer: The hash tool is not certified. Tool is use as reference
          only. It should never be used in the cryptography. The algorithm is
          based on crypto-js library.
        </Alert>
        <div className="card-body">
          <h5 className="card-title">Input</h5>
          <div className="card-text">
            <OptionSelector
              inputName="hashDirection"
              defaultValue={this.state.selectedDirection}
              options={directionsList}
              onChange={(value) => {
                this.handleDirectionUpdate(value);
              }}
            />
            <Form.Control
              as="textarea"
              rows={3}
              placeholder="Enter input here..."
              onChange={(e) => {
                this.handleInputUpdate(e.target.value);
              }}
            />
          </div>
        </div>
        <hr />
        <div className="card-body">
          <h5 className="card-title">Output</h5>
          <div className="card-text">
            <OptionSelector
              inputName="algorithmDirection"
              defaultValue={this.state.selectedAlgorithm}
              options={algorithmsList}
              onChange={(value) => {
                this.handleAlgorithmUpdate(value);
              }}
            />
            <Form.Control
              as="textarea"
              rows={3}
              placeholder="Computed output will be displayed here..."
              readOnly={true}
              value={this.state.computedValue}
            />
          </div>
        </div>
      </div>
    );
  }
}

jQuery(function () {
  let toolDomContainer = document.querySelector("#tool");

  const root = createRoot(toolDomContainer!);
  root.render(<HashCalculatorTool />);
});
