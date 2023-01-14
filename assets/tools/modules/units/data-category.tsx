import { UnitCategory } from "./unit-category";
import { UnitDefinition } from "./unit-definition";

export class DataCategory {
  public static GetCategory(): UnitCategory {
    return {
      name: "Data",
      code: "d",
      baseUnit: "d/b",
    };
  }

  public static GetUnits(): UnitDefinition[] {
    return [
      {
        categoryCode: "d",
        code: "d/b",
        symbol: "b",
        name: "bit",
        isSiUnit: false,
      },
    ];
  }
}
