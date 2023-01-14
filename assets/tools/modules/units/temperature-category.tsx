import { UnitCategory } from "./unit-category";
import { UnitDefinition } from "./unit-definition";

export class TemperatureCategory {
  public static GetCategory(): UnitCategory {
    return {
      name: "Temperature",
      code: "T",
      baseUnit: "T/K",
    };
  }

  public static GetUnits(): UnitDefinition[] {
    return [
      {
        categoryCode: "T",
        code: "T/C",
        symbol: "C",
        name: "celsius",
        isSiUnit: false,
        cFrom: (n) => n + 273.15,
        cInto: (n) => n - 273.15,
      },
      {
        categoryCode: "T",
        code: "T/F",
        symbol: "F",
        name: "fahrenheit",
        isSiUnit: false,
        cFrom: (n) => ((n + 459.67) * 5.0) / 9.0,
        cInto: (n) => (n / 5.0) * 9.0 - 459.67,
      },
      {
        categoryCode: "T",
        code: "T/K",
        symbol: "K",
        name: "kelvin",
        isSiUnit: false,
      },
    ];
  }
}
