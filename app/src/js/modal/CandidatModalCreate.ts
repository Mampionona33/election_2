import { Modal } from "bootstrap";
import { IModal } from "./IModal";

export class CandidatModalCreate implements IModal {
  private modalElement: Element | null;

  /**
   * Getter and setter
   */
  public getModalElement(): Element | null {
    return this.modalElement;
  }
  public setModalElement(modalElement: Element | null) {
    this.modalElement = modalElement;
  }

  // --------------------------------------
  show() {
    this.modalElement = this.modalElement ?? document.createElement("div");
    this.modalElement.classList.add("modal", "fade");
    this.modalElement.setAttribute("id", "createModal");
    this.modalElement.innerHTML = this.generateModalContent();
    document.body.appendChild(this.modalElement);

    // Initialiser le modal Bootstrap
    const modal = new Modal(this.modalElement);

    // Afficher le modal
    modal.show();

    // Gérer les événements et les interactions du modal ici...
  }

  private generateModalContent() {
    return `
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Titre</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" id="form_modal">
            <div class="modal-body">
              <div class="d-flex justify-content-center align-items-center">
                <div class="col-9">Body</div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" id="create_candidat" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    `;
  }
}
