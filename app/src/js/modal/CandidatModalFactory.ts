import { IModal } from "./IModal";
import { ModalFactory } from "./ModalFactory";
import { CandidatModalCreate } from "./CandidatModalCreate";
import { ModalType } from "./ModalType";
import { CandidatModalUpdate } from "./CandidatModalUpdate";

export class CandidatModalFactory extends ModalFactory {
  protected rowId: number;
  private candidatModalUpdate: CandidatModalUpdate;
  /**
   * Getter and setter
   */
  public setRowId(rowId: number) {
    this.rowId = rowId;
  }
  public getRowId(): number {
    return this.rowId;
  }
  public setCandidatModalUpdate(
    candidatModalUpdate: CandidatModalUpdate
  ): void {
    this.candidatModalUpdate = candidatModalUpdate;
  }
  public getCandidatModalUpdate(): CandidatModalUpdate {
    return this.candidatModalUpdate;
  }
  // ------------------------------

  createModal(type: ModalType): IModal {
    switch (type) {
      case ModalType.Create:
        return new CandidatModalCreate();
        break;
      case ModalType.Update:
        this.setCandidatModalUpdate(new CandidatModalUpdate(this.rowId));
        return this.candidatModalUpdate;
        break;

      default:
        throw new Error("Type de modal non pris en charge.");
        break;
    }
  }
}
