import { UnitCategory } from "./unit-category";
import { UnitDefinition } from "./unit-definition";

export class WeightAndMassCategory {
  public static GetCategory(): UnitCategory {
    return {
      name: "Weight and mass",
      code: "m",
      baseUnit: "m/g",
    };
  }

  public static GetUnits(): UnitDefinition[] {
    return [
      {
        categoryCode: "m",
        code: "m/g",
        symbol: "g",
        name: "gram",
        isSiUnit: true,
      },
    ];
  }
}
