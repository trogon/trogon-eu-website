// assets/tools/resistance.tsx
"use strict";

import "./styles/resistance.scss";

import jQuery from "jquery";

import React, { Component } from "react";
import { createRoot } from "react-dom/client";

import ToggleButton from "react-bootstrap/ToggleButton";
import ToggleButtonGroup from "react-bootstrap/ToggleButtonGroup";

const resistorBands: string[] = ["1", "2", "3", "4", "5", "6"];
const resistorColors: string[] = [
  "Black",
  "Brown",
  "Red",
  "Orange",
  "Yellow",
  "Green",
  "Blue",
  "Violet",
  "Grey",
  "White",
];

const resistorColorsValue: number[][] = [
  [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
  [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
  [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
  [
    1, 10, 100, 1000, 10000, 100000, 1000000, 10000000, 100000000, 1000000000,
    0.1, 0.01,
  ],
  [-1, 1, 2, 3, 4, 0.5, 0.25, 0.1, 0.05, -1, 5, 10],
  [250, 100, 50, 15, 25, 20, 10, 5, 1],
];
const columSelector: number[][] = [
  [0, 1, 3],
  [0, 1, 3, 4],
  [0, 1, 2, 3, 4],
  [0, 1, 2, 3, 4, 5],
];

function scaleUnitSi(value: number): [number, string] {
  if (value >= 1000000000) {
    return [value / 1000000000.0, "G"];
  } else if (value >= 1000000) {
    return [value / 1000000.0, "M"];
  } else if (value >= 1000) {
    return [value / 1000.0, "K"];
  } else {
    return [value, ""];
  }
}

class ResistorValueTool extends Component {
  state = {
    resistorSelection: [-1, -1, -1, -1, -1, -1],
    computedValue: "Unknown yet",
  };

  constructor(props: any) {
    super(props);

    // This binding is necessary to make `this` work in the callback
    this.handleChange = this.handleChange.bind(this);
  }

  computeResistance(selectedValues: number[]): string {
    let resistance = "";

    columSelector.forEach((columns) => {
      if (selectedValues.length == columns.length) {
        columns.forEach((column, idx) => {
          const value = selectedValues[idx];
          const colorValue = resistorColorsValue[column][value];

          if (column < 3) {
            resistance += `${colorValue}`;
          } else if (column == 3) {
            const resistanceScaled = scaleUnitSi(
              Number(resistance) * colorValue
            );
            resistance = `${resistanceScaled[0]}${resistanceScaled[1]}Ω`;
          } else {
            const unit = column == 4 ? "%" : "ppm/K";
            const prefix = column == 4 ? "±" : "";

            resistance += ` ${prefix}${colorValue}${unit}`;
          }
        });
      }
    });

    return resistance;
  }

  handleChange(band: string, value: string): void {
    const bandIndex = resistorBands.indexOf(band);
    const colorIndex = resistorColors.indexOf(value);

    let resistorSelection = this.state.resistorSelection;
    resistorSelection[bandIndex] = colorIndex;
    this.setState({
      resistorSelection: resistorSelection,
    });

    const selectedValues = resistorSelection.filter((x) => x > -1);
    this.setState({
      computedValue: this.computeResistance(selectedValues),
    });
  }

  render() {
    const defaultValue = "None";

    return (
      <div className="row">
        <div className="col-8">
          {resistorBands.map((band) => (
            <ToggleButtonGroup
              key={"band-" + band}
              type="radio"
              className="me-1"
              name={"band-" + band}
              defaultValue={defaultValue}
              vertical={true}
              onChange={(value, _) => this.handleChange(band, value)}
            >
              {[defaultValue, ...resistorColors].map((color) => (
                <ToggleButton
                  key={"band-" + band + "-" + color}
                  id={"band-" + band + "-" + color}
                  className={"band-color-" + color}
                  value={color}
                >
                  {color}
                </ToggleButton>
              ))}
            </ToggleButtonGroup>
          ))}
        </div>
        <div className="col-4">Resistance: {this.state.computedValue}</div>
      </div>
    );
  }
}

jQuery(function () {
  let toolDomContainer = document.querySelector("#tool");

  const root = createRoot(toolDomContainer!);
  root.render(<ResistorValueTool />);
});
