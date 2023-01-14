import { UnitDefinition } from "./unit-definition";
import { UnitScale } from "./unit-scale";

export interface UnitInstance {
  unit: UnitDefinition;
  scale?: UnitScale;
  code: string;
  symbol: string;
  name: string;
}
