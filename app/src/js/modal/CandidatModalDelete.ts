import { IModal } from "./IModal";
import { ModalBase } from "./ModalBase";

export class CandidatModalDelete extends ModalBase implements IModal {
  private candidatData: object;

  /**
   * getter and setter
   */

  public setCandidatData(candidatData: object) {
    this.candidatData = candidatData;
  }

  public getCandidatData(): object {
    return this.candidatData;
  }

  constructor(candidatData: object) {
    super();
    this.setCandidatData(candidatData);
    this.setModalTitle("Supprimer candidat");
    this.setSubmitLabel("Supprimer");
    this.setModalBody(this.generateModalBody());
    this.setPath(
      window.location.pathname.slice(1, window.location.pathname.length)
    );
  }
  private generateModalBody(): string {
    console.log(this.candidatData);

    return `
        <div class="form-group row">
          <div class="">
            Êtes-vous sûr de vouloir supprimer le candidat ${this.candidatData["name"]} ?
          </div>
        </div>
        `;
  }
}
