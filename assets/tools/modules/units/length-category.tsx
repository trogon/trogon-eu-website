import { UnitCategory } from "./unit-category";
import { UnitDefinition } from "./unit-definition";

export class LengthCategory {
  public static GetCategory(): UnitCategory {
    return {
      name: "Length",
      code: "l",
      baseUnit: "l/m",
    };
  }

  public static GetUnits(): UnitDefinition[] {
    return [
      {
        categoryCode: "l",
        code: "l/m",
        symbol: "m",
        name: "meter",
        isSiUnit: true,
      },
      {
        categoryCode: "l",
        code: "l/im",
        symbol: '"',
        name: "inch",
        isSiUnit: false,
        cFrom: (n) => n / (100 / 2.54), // Metric (SI) units: 25.4 mm
        cInto: (n) => n * (100 / 2.54),
      },
      {
        categoryCode: "l",
        code: "l/ft",
        symbol: "ft",
        name: "feet",
        isSiUnit: false,
        cFrom: (n) => n / (100 / 2.54 / 12), // 12 inch
        cInto: (n) => n * (100 / 2.54 / 12),
      },
      {
        categoryCode: "l",
        code: "l/yd",
        symbol: "yd",
        name: "yard",
        isSiUnit: false,
        cFrom: (n) => n / (100 / 2.54 / 12 / 3), // 3 feet
        cInto: (n) => n * (100 / 2.54 / 12 / 3),
      },
      {
        categoryCode: "l",
        code: "l/mile",
        symbol: "NM",
        name: "mile",
        isSiUnit: false,
        cFrom: (n) => n / (100 / 2.54 / 12 / 3 / 1760), // 1760 yard
        cInto: (n) => n * (100 / 2.54 / 12 / 3 / 1760),
      },
      {
        categoryCode: "l",
        code: "l/n-mile",
        symbol: "NM",
        name: "nautical mile",
        isSiUnit: false,
        cFrom: (n) => n * 1852, // Metric (SI) units: 1852 m
        cInto: (n) => n / 1852,
      },
    ];
  }
}
