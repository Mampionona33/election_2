import { IModal } from "./IModal";
import { ModalBase } from "./ModalBase";

export class CandidatModalDelete extends ModalBase implements IModal {
  constructor() {
    super();
    this.setModalTitle("Supprimer candidat");
    this.setSubmitLabel("Supprimer");
    this.setPath(
      window.location.pathname.slice(1, window.location.pathname.length)
    );
  }
  private generateModalBody(): string {
    return `
        <div class="form-group row">
          <label for="name" class="col-sm-6 col-form-label">Nom</label>
          <div class="col-sm-6">
            <input type="text" class="form-control form-control-sm" name="name" id="name" value="" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="nb_voix" class="col-sm-6 col-form-label">Nombre de voix</label>
          <div class="col-sm-6">
            <input type="number" class="form-control form-control-sm" name="nb_voix" id="nb_voix" value="" required>
          </div>
        </div>
        `;
  }
}
