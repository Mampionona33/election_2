import { Modal } from "bootstrap";
import { IModal } from "./IModal";

export abstract class CandidatBaseModel implements IModal {
  protected modalElement: Element | null;
  protected title: string | null;
  protected body: string | null;
  protected submitId: string;
  protected submitLabel: string;
  protected modal: Modal;
  protected handleSubmit: Function;
  /**
   * Getter and setter
   */
  public setHandleSubmit(handleSubmit: Function): void {
    this.handleSubmit = handleSubmit;
  }
  public getHandleSubmit(): Function {
    return this.handleSubmit;
  }
  public setModal(modal: Modal) {
    this.modal = modal;
  }
  public getModal(): Modal {
    return this.modal;
  }
  public setSubmitLabel(submitLabel: string) {
    this.submitLabel = submitLabel;
  }
  public getSubmitLabel(): string {
    return this.submitLabel;
  }
  public setSubmitId(submitId: string) {
    this.submitId = submitId;
  }
  public getSubmitId(): string {
    return this.submitId;
  }
  public setModalBody(body: string | null): void {
    this.body = body;
  }
  public getModalBody(): string | null {
    return this.body;
  }
  public setModalTitle(title: string): void {
    this.title = title;
  }
  public getModalTitle(): string | null {
    return this.title;
  }
  public getModalElement(): Element | null {
    return this.modalElement;
  }
  public setModalElement(modalElement: Element | null) {
    this.modalElement = modalElement;
  }
  //   ---------------------------
  constructor() {
    this.setModalTitle("Title");
    this.setSubmitLabel("Save");
    this.setSubmitId("submit");
  }

  show(): void {
    this.modalElement = this.modalElement ?? document.createElement("div");
    this.modalElement.classList.add("modal", "fade");
    this.modalElement.innerHTML = this.generateModalForm();
    document.body.appendChild(this.modalElement);

    // Initialiser le modal Bootstrap
    this.setModal(
      new Modal(this.modalElement, {
        backdrop: true,
        keyboard: true,
      })
    );
    // Ajouter la classe "show" pour afficher le modal
    this.modalElement.classList.add("show");

    // Supprimer le modal lorsque il est fermé
    this.modalElement.addEventListener("hidden.bs.modal", () => {
      this.modalElement!.remove();
    });

    this.modalElement
      .querySelector("#form_modal")
      ?.addEventListener("submit", (ev) => this.handleSubmit(ev));

    // Afficher le modal
    this.modal.show();
  }

  generateModalForm(): string {
    return `
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">${this.title ? this.title : ""}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" id="form_modal">
            <div class="modal-body">
              <div class="d-flex justify-content-center align-items-center">
                <div class="col-9">
                    ${this.body ? this.body : ""}
                </div>
              </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" id="${
                this.submitId
              }" class="btn btn-primary">${this.submitLabel}</button>
            </div>
          </form>
        </div>
      </div>
    `;
  }
}
