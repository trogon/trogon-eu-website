import { UnitCategory } from "./unit-category";
import { UnitDefinition } from "./unit-definition";

export class TimeCategory {
  public static GetCategory(): UnitCategory {
    return {
      name: "Time",
      code: "t",
      baseUnit: "t/s",
    };
  }

  public static GetUnits(): UnitDefinition[] {
    return [
      {
        categoryCode: "t",
        code: "t/s",
        symbol: "s",
        name: "second",
        isSiUnit: true,
      },
    ];
  }
}
