import { Modal } from "bootstrap";

export class CustomTableHandler {
  protected addButton?: Element | null;
  protected editButton?: HTMLButtonElement;
  protected deleteButton?: HTMLButtonElement;
  protected path?: string;
  protected modalButtonSubmitLabel: string;
  protected modalButtonSubmitId: string;
  protected modalElement: HTMLElement;
  protected modal: Modal;

  /**
   * Getters and setters
   */
  public setModalElement(modalElement: HTMLElement): void {
    this.modalElement = modalElement;
  }

  public getModalElement(): HTMLElement {
    return this.modalElement;
  }

  public setModalButtonSubmitId(modalButtonSubmitId: string): void {
    this.modalButtonSubmitId = modalButtonSubmitId;
  }

  public getModalButtonSubmitId(): string {
    return this.modalButtonSubmitId;
  }

  public setModalButtonSubmitLabel(modalButtonSubmitLabel: string): void {
    this.modalButtonSubmitLabel = modalButtonSubmitLabel;
  }

  public getModalButtonSubmitLabel(): string {
    return this.modalButtonSubmitLabel;
  }

  public setAddButton(addButton?: Element): void {
    this.addButton = addButton;
  }

  public getAddButton(): Element | undefined | null {
    return this.addButton;
  }

  public setEditButton(editButton?: HTMLButtonElement): void {
    this.editButton = editButton;
  }

  public getEditButton(): HTMLButtonElement | undefined {
    return this.editButton;
  }

  public setDeleteButton(deleteButton?: HTMLButtonElement): void {
    this.deleteButton = deleteButton;
  }

  public getDeleteButton(): HTMLButtonElement | undefined {
    return this.deleteButton;
  }

  public setPath(path?: string): void {
    this.path = path;
  }

  public getPath(): string | undefined {
    return this.path;
  }

  // -------------------------------------------------

  constructor() {
    this.modalElement = document.createElement("div");
    this.modalElement.classList.add("div");
    this.handleClickAdd();
  }

  protected handleClickAdd(): void {
    if (this.addButton) {
      this.addButton?.addEventListener("click", (ev) => {
        console.log(this.addButton);
        console.log("test");
        ev.preventDefault();
        this.createModal(this.generateModal("Créer"));
      });
    }
  }

  private createModal(modalForm: string): void {
    this.modalElement.innerHTML = modalForm;
    document.body.appendChild(this.modalElement);
    this.modal = new Modal(this.modalElement, {
      backdrop: true,
      keyboard: true,
    });
    this.modal.show();
  }

  protected generateModal(title: string, data?: object): string {
    if (data) {
      // Utiliser les données existantes pour le mode édition
      this.modalButtonSubmitLabel = "Modifier";
      this.modalButtonSubmitId = "submit_modal_update";
    } else {
      // Utiliser des valeurs par défaut pour le mode création
      this.modalButtonSubmitLabel = "Ajouter";
      this.modalButtonSubmitId = "submit_modal_create";
    }

    return `
    <div class="modal-dialog modal-dialog-centered "> <!-- Ajoutez la classe "modal-lg" pour agrandir la largeur -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">${title}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" id="form_modal">
        <div class="modal-body">
          <div class="d-flex justify-content-center align-items-center">
            <div class="col-9">Test</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="${this.modalButtonSubmitId}" class="btn btn-primary">${this.modalButtonSubmitLabel}</button>
        </div>
      </form>
    </div>
  </div>
    `;
  }
}
