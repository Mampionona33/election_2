import { Modal } from "bootstrap";

export class CustomTableHandler {
  protected addButton?: Element | null;
  protected editButton?: Element | null;
  protected deleteButton?: HTMLButtonElement;
  protected path?: string;
  protected modalButtonSubmitLabel: string;
  protected modalButtonSubmitId: string;
  protected modalElement: HTMLElement;
  protected modal: Modal;
  protected modalAddtitle: string;
  protected modalEditTitle: string;
  protected rowId?: number;
  protected ressourceIdKey?: string;
  protected modalForm: Function;

  /**
   * Getters and setters
   */
  public setRessourceIdKey(ressourceIdKey?: string) {
    this.ressourceIdKey = ressourceIdKey;
  }
  public getRessourceIdKey(): string | undefined {
    return this.ressourceIdKey;
  }
  public setRowId(rowId?: number): void {
    this.rowId = rowId;
  }
  public getRowId(): number | undefined {
    return this.rowId;
  }
  public setModalEditTitle(modalEditTitle: string): void {
    this.modalEditTitle = modalEditTitle;
  }
  public getModalEditTitle(): string {
    return this.modalEditTitle;
  }
  public setModalAddtitle(modalAddtitle: string) {
    this.modalAddtitle = modalAddtitle;
  }
  public getModalAddtitle(): string {
    return this.modalAddtitle;
  }
  public setModalForm(modalForm: Function) {
    this.modalForm = modalForm;
  }
  public getModalForm(): Function {
    return this.modalForm;
  }
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

  public setAddButton(addButton?: Element | null): void {
    this.addButton = addButton;
  }

  public getAddButton(): Element | undefined | null {
    return this.addButton;
  }

  public setEditButton(editButton?: Element | null): void {
    this.editButton = editButton;
  }

  public getEditButton(): Element | null | undefined {
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

  constructor(ressourceIdKey: string) {
    this.setRessourceIdKey(ressourceIdKey);
    this.modalElement = document.createElement("div");
    this.modalElement.classList.add("modal");
    this.removeModal();
    this.setModalAddtitle("Créer");
    this.setModalEditTitle("Modifier");
    this.setPath(
      window.location.pathname.slice(1, window.location.pathname.length)
    );
  }

  protected handleClickAdd(): void {
    if (this.addButton) {
      this.addButton?.addEventListener("click", (ev) => {
        ev.preventDefault();
        this.createModal(this.generateModal(this.modalAddtitle));
      });
    }
  }

  protected handleClickEdit() {
    if (this.editButton) {
      this.editButton?.addEventListener("click", async (ev) => {
        ev.preventDefault();
        this.setRowId(parseInt((ev.target as HTMLElement).dataset.id!));
        const res = await this.get();
        if (res.status === 200) {
          console.log(res.data.data[0]);
          this.createModal(
            this.generateModal(this.modalEditTitle, res.data.data[0])
          );
        }
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

    // Ajouter la classe "show" pour afficher le modal
    this.modalElement.classList.add("show");

    // Supprimer la classe "show" lorsque le modal est fermé
    this.modalElement.addEventListener("hidden.bs.modal", () => {
      this.modalElement.classList.remove("show");
    });

    this.modal.show();

    // Lancer l'ecoute du formulaire après son création
    this.modalElement
      .querySelector("#form_modal")
      ?.addEventListener("submit", (ev) => {
        this.handleSubmitModal(ev);
      });
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
    <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">${title}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" id="form_modal">
        <div class="modal-body">
          <div class="d-flex justify-content-center align-items-center">
            <div class="col-9">${this.modalForm(data ? data : null)}</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="${
            this.modalButtonSubmitId
          }" class="btn btn-primary">${this.modalButtonSubmitLabel}</button>
        </div>
      </form>
    </div>
  </div>
    `;
  }

  private removeModal(): void {
    document.body.addEventListener("hidden.bs.modal", (ev) => {
      this.modalElement.remove();
    });
  }

  private async handleSubmitModal(ev: Event) {
    ev.preventDefault();
    const form = ev.target as HTMLFormElement;
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    if (this.modalButtonSubmitId === "submit_modal_create") {
      const resp = await this.post(data);
      if (resp.status === 200) {
        console.log(resp);
        window.location.reload();
      }
    } else {
      if (this.ressourceIdKey && this.rowId) {
        data[this.ressourceIdKey!] = String(this.rowId!);
      }
      const resp = await this.put(data);
      console.log(resp.status);
      if (resp.status === 200) {
        window.location.reload();
      }
    }
  }

  /**
   * method for fetch and post data
   */

  async post(data: object): Promise<{ status: number; data: any }> {
    try {
      const req = await fetch(`api/${this.path}`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      });
      const resp = await req.json();
      console.log(resp);

      return {
        status: req.ok ? req.status : 0,
        data: resp,
      };
    } catch (error) {
      throw error;
    }
  }

  async get(): Promise<{ status: number; data: any }> {
    try {
      const res = await fetch(
        `api/${this.path}?${this.ressourceIdKey}=${this.rowId}`
      );
      if (!res.ok) {
        throw new Error("Unable to fetch data from API.");
      }
      const data = await res.json();
      return {
        status: res.status,
        data,
      };
    } catch (error) {
      throw error;
    }
  }

  async put(data: object): Promise<{ status: number; data: any }> {
    try {
      const response = await fetch(`api/${this.path}`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      });
      const resp = await response.json();
      return {
        status: response.status,
        data: resp,
      };
    } catch (error) {
      throw error;
    }
  }
}
