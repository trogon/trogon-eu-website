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

import {
  AngleCategory,
  DataCategory,
  LengthCategory,
  siScale,
  TemperatureCategory,
  TimeCategory,
  UnitCategory,
  UnitDefinition,
  UnitInstance,
  WeightAndMassCategory,
} from "./modules/units";

const unitCategories: UnitCategory[] = [
  // Primary units (not composed)
  AngleCategory.GetCategory(),
  DataCategory.GetCategory(),
  LengthCategory.GetCategory(),
  TemperatureCategory.GetCategory(),
  TimeCategory.GetCategory(),
  WeightAndMassCategory.GetCategory(),
];

const baseUnits: UnitDefinition[] = [
  ...AngleCategory.GetUnits(),
  ...DataCategory.GetUnits(),
  ...LengthCategory.GetUnits(),
  ...TemperatureCategory.GetUnits(),
  ...TimeCategory.GetUnits(),
  ...WeightAndMassCategory.GetUnits(),
];

interface UnitConvertState {
  categories: UnitCategory[];
  category: number;
  units: UnitInstance[];
  sourceUnit: number;
  targetUnit: number;
  sourceValue?: number;
  targetValue?: number;
}

class PhysicsCalculatorTool extends Component {
  defaultCategory = 0;
  state: UnitConvertState = {
    categories: unitCategories,
    category: this.defaultCategory,
    units: this.getCategoryUnits(unitCategories[this.defaultCategory].code),
    sourceUnit: 0,
    targetUnit: 0,
  };

  constructor(props: any) {
    super(props);

    // This binding is necessary to make `this` work in the callback
    this.handleCategoryChange = this.handleCategoryChange.bind(this);
    this.handleSourceUnitChange = this.handleSourceUnitChange.bind(this);
    this.handleTargetUnitChange = this.handleTargetUnitChange.bind(this);

    this.updateResults = this.updateResults.bind(this);
  }

  convertValue(
    sUnit: UnitInstance | undefined,
    tUnit: UnitInstance | undefined,
    value: number | undefined
  ): number | undefined {
    if (sUnit && tUnit && value !== undefined) {
      let rValue = value;
      // Undo scale
      if (sUnit.scale) {
        rValue = rValue * sUnit.scale.factor;
      }
      // Convert to base unit
      if (sUnit.unit.cFrom) {
        rValue = sUnit.unit.cFrom(rValue);
      }
      // Convert from base unit
      if (tUnit.unit.cInto) {
        rValue = tUnit.unit.cInto(rValue);
      }
      // Apply scale
      if (tUnit.scale) {
        rValue = rValue / tUnit.scale.factor;
      }
      return rValue;
    }

    return undefined;
  }

  getCategoryUnits(categoryCode: string): UnitInstance[] {
    const categoryBaseUnits = baseUnits.filter(
      (unit) => unit.categoryCode == categoryCode
    );

    const units: UnitInstance[] = categoryBaseUnits
      .filter((unit) => unit.isSiUnit === false)
      .map((unit) => ({
        unit: unit,
        name: unit.name,
        code: unit.code,
        symbol: unit.symbol,
      }));

    const siUnits: UnitInstance[] = categoryBaseUnits
      .filter((unit) => unit.isSiUnit === true)
      .flatMap((unit) =>
        siScale.flatMap((scale) => ({
          unit: unit,
          scale: scale,
          name: `${scale.prefix}${unit.name}`,
          code:
            `${scale.symbol}`.length > 0
              ? `${unit.code}/${scale.symbol}`
              : `${unit.code}`,
          symbol: `${scale.symbol}${unit.symbol}`,
        }))
      );

    return units.concat(siUnits);
  }

  handleCategoryChange(newCategory: number): void {
    const category = this.state.categories[newCategory];
    const newUnits = this.getCategoryUnits(category.code);
    const defaultUnit = newUnits.find(
      (unit) =>
        category.baseUnit == unit.unit.code &&
        (unit.scale === undefined || unit.scale?.factor === 1)
    );

    const selectedIndex =
      defaultUnit === undefined ? 0 : newUnits.indexOf(defaultUnit);

    this.updateResults({
      ...this.state,
      category: newCategory,
      units: newUnits,
      sourceUnit: selectedIndex,
      targetUnit: selectedIndex,
    });
  }

  handleSourceUnitChange(newUnit: number): void {
    this.updateResults({
      ...this.state,
      sourceUnit: newUnit,
    });
  }

  handleTargetUnitChange(newUnit: number): void {
    this.updateResults({
      ...this.state,
      targetUnit: newUnit,
    });
  }

  handleSourceValueChange(newValue: string): void {
    this.updateResults({
      ...this.state,
      sourceValue: newValue ? Number(newValue) : undefined,
    });
  }

  updateResults(newParameters: UnitConvertState): void {
    const sUnit = newParameters.units[newParameters.sourceUnit];
    const tUnit = newParameters.units[newParameters.targetUnit];
    const sVal = newParameters.sourceValue;
    const tVal = this.convertValue(sUnit, tUnit, sVal);

    this.setState({
      ...newParameters,
      targetValue: tVal,
    });
  }

  render() {
    return (
      <div className="card-body">
        <Form>
          <Row className="mb-3">
            <Col>
              <Form.Group controlId="formUnitCategory">
                <Form.Label>Measurement catagory</Form.Label>
                <InputGroup>
                  <InputGroup.Text>
                    <FontAwesomeIcon icon={faPencil} />
                  </InputGroup.Text>
                  <Form.Select
                    onChange={(e) =>
                      this.handleCategoryChange(e.target.selectedIndex)
                    }
                  >
                    {this.state.categories.map((category) => (
                      <option
                        key={`${category.code}`}
                        value={`${category.code}`}
                      >{`${category.name}`}</option>
                    ))}
                  </Form.Select>
                </InputGroup>
                <Form.Text className="text-muted">
                  Units domain. A group of units that can be converted between.
                </Form.Text>
              </Form.Group>
            </Col>

            <Col>
              <Form.Group controlId="formSourceUnit">
                <Form.Label>Measurement unit</Form.Label>
                <InputGroup>
                  <InputGroup.Text>
                    <FontAwesomeIcon icon={faPencil} />
                  </InputGroup.Text>
                  <Form.Select
                    value={this.state.units[this.state.sourceUnit]?.code}
                    onChange={(e) =>
                      this.handleSourceUnitChange(e.target.selectedIndex)
                    }
                  >
                    {this.state.units.map((unit) => (
                      <option
                        key={`${unit.code}`}
                        value={`${unit.code}`}
                      >{`${unit.name} (${unit.symbol})`}</option>
                    ))}
                  </Form.Select>
                </InputGroup>
                <Form.Text className="text-muted">
                  Unit of measurement, base unit to convert from.
                </Form.Text>
              </Form.Group>
            </Col>

            <Col>
              <Form.Group controlId="formTargetUnit">
                <Form.Label>Desired unit</Form.Label>
                <InputGroup>
                  <InputGroup.Text>
                    <FontAwesomeIcon icon={faPencil} />
                  </InputGroup.Text>
                  <Form.Select
                    value={this.state.units[this.state.targetUnit]?.code}
                    onChange={(e) =>
                      this.handleTargetUnitChange(e.target.selectedIndex)
                    }
                  >
                    {this.state.units.map((unit) => (
                      <option
                        key={`${unit.code}`}
                        value={`${unit.code}`}
                      >{`${unit.name} (${unit.symbol})`}</option>
                    ))}
                  </Form.Select>
                </InputGroup>
                <Form.Text className="text-muted">
                  Desired unit, target unit to convert into.
                </Form.Text>
              </Form.Group>
            </Col>
          </Row>

          <Row className="mb-3">
            <Col>
              <Form.Group controlId="formSourceValue">
                <Form.Label>Measurement</Form.Label>
                <InputGroup>
                  <InputGroup.Text>
                    <FontAwesomeIcon icon={faPencil} />
                  </InputGroup.Text>
                  <Form.Control
                    type="number"
                    placeholder="Enter measurement in chosen unit."
                    onChange={(e) =>
                      this.handleSourceValueChange(e.target.value)
                    }
                    value={this.state.sourceValue}
                  />
                </InputGroup>
                <Form.Text className="text-muted">
                  Value of measurement in chosen unit.
                </Form.Text>
              </Form.Group>
            </Col>

            <Col>
              <Form.Group controlId="formTargetValue">
                <Form.Label>Corresponding value in destination unit</Form.Label>
                <Form.Control
                  type="text"
                  placeholder="Computed measurement in chosen unit."
                  readOnly
                  value={this.state.targetValue}
                />
                <Form.Text className="text-muted">
                  Value of measurement converted into chosen unit.
                </Form.Text>
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
  root.render(<PhysicsCalculatorTool />);
});
