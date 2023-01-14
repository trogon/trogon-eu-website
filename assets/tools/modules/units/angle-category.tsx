import { UnitCategory } from "./unit-category";
import { UnitDefinition } from "./unit-definition";

export class AngleCategory {
  public static GetCategory(): UnitCategory {
    return {
      name: "Angle",
      code: "a",
      baseUnit: "a/r",
    };
  }

  public static GetUnits(): UnitDefinition[] {
    return [
      {
        categoryCode: "a",
        code: "a/r",
        symbol: "rad",
        name: "radian",
        isSiUnit: false,
      },
      {
        categoryCode: "a",
        code: "a/deg",
        symbol: "deg",
        name: "degree",
        isSiUnit: false,
        cFrom: (n) => (n / 180) * Math.PI, // Metric (SI) units: 180 deg = PI rad
        cInto: (n) => (n / Math.PI) * 180,
      },
      {
        categoryCode: "a",
        code: "a/grad",
        symbol: "grad",
        name: "gradian",
        isSiUnit: false,
        cFrom: (n) => (n / 200) * Math.PI, // Metric (SI) units: 200 grad = PI rad
        cInto: (n) => (n / Math.PI) * 200,
      },
    ];
  }
}
