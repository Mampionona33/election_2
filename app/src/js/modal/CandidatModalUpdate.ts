import { IModal } from "./IModal";
import { ModalBase } from "./ModalBase";
import { CandidatModalCreate } from "./CandidatModalCreate";

export class CandidatModalUpdate extends ModalBase implements IModal {
  private candidatData: object;
  protected rowId: number;
  /**
   * Getter and setter
   */
  public setRowId(rowId: number) {
    this.rowId = rowId;
  }
  public getRowId(): number {
    return this.rowId;
  }
  public setCandidatData(candidatData: object) {
    this.candidatData = candidatData;
  }

  public getCandidatData(): object {
    return this.candidatData;
  }
  // -------------------------------
  constructor(candidatData) {
    super();
    this.setCandidatData(candidatData);
    this.setModalTitle("Modifier candidat");
    this.setModalBody(this.generateModalBody());
    this.setSubmitLabel("Modifier");
    this.setPath(
      window.location.pathname.slice(1, window.location.pathname.length)
    );
  }

  private generateModalBody(): string {
    console.log(this.candidatData);
    
    return `
        <div class="form-group row">
        <label for="name" class="col-sm-6 col-form-label">Nom</label>
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-sm" name="name" id="name" value="${this.candidatData["name"]}" required>
        </div>
        </div>
        <div class="form-group row">
        <label for="nb_voix" class="col-sm-6 col-form-label">Nombre de voix</label>
        <div class="col-sm-6">
            <input type="number" class="form-control form-control-sm" name="nb_voix" id="nb_voix" value="${this.candidatData["nb_voix"]}" required>
        </div>
        </div>
        `;
  }
 
}
