export interface UnitDefinition {
  name: string;
  code: string;
  symbol: string;
  categoryCode: string;
  components?: string[][];
  isSiUnit: boolean;
  cFrom?: (n: number) => number;
  cInto?: (n: number) => number;
}
