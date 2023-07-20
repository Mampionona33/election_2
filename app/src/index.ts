import * as bootstrap from "bootstrap";
// import TableCandidatHandler from "./js/TableCandidatHandler";
import { ModalType } from "./js/modal/ModalType";
import { CandidatModalFactory } from "./js/modal/CandidatModalFactory"; // Import CandidatModalFactory ici
import { IModal } from "./js/modal/IModal";

class App {
  private addButton: Element | null;
  private editButtons: NodeListOf<Element> | null;
  private deleteButtons: NodeListOf<Element> | null;
  private modalType: ModalType;
  private candidatModalFactory: CandidatModalFactory;
  private candidatModal: IModal;
  private path: string;
  private ressourceIdKey: string;
  protected rowId: number;

  constructor() {
    this.addButton = document.getElementById("table-btn-add");
    this.setEditButtons(document.querySelectorAll('button[name="edit"]'));
    this.setDeleteButtons(document.querySelectorAll('button[name="delete"]'));
    this.handleClickButton();
  }

  /**
   * Getter and Setter
   */

  public setRowId(rowId: number) {
    this.rowId = rowId;
  }
  public getRowId(): number {
    return this.rowId;
  }
  public setPath(path: string): void {
    this.path = path;
  }
  public getPath(): string {
    return this.path;
  }
  public setRessourceIdKey(ressourceIdKey: string) {
    this.ressourceIdKey = ressourceIdKey;
  }
  public getRessourceIdKey(): string {
    return this.ressourceIdKey;
  }
  public setCandidatModal(candidatModal: IModal) {
    this.candidatModal = candidatModal;
  }
  public getCandidatModal(): IModal {
    return this.candidatModal;
  }
  public setCandidatModalFactory(
    candidatModalFactory: CandidatModalFactory
  ): void {
    this.candidatModalFactory = candidatModalFactory;
  }
  public getcandidatModalFactory(): CandidatModalFactory {
    return this.candidatModalFactory;
  }
  public setModalType(modalType: ModalType): void {
    this.modalType = modalType;
  }
  public getModalType(): ModalType {
    return this.modalType;
  }
  public setEditButtons(editButtons: NodeListOf<Element> | null) {
    this.editButtons = editButtons;
  }
  public setDeleteButtons(deleteButtons: NodeListOf<Element> | null) {
    this.deleteButtons = deleteButtons;
  }
  public getDeleteButtons(): NodeListOf<Element> | null {
    return this.deleteButtons;
  }
  public setAddButton(addButton: Element | null): void {
    this.addButton = addButton;
  }
  public getAddButton(): Element | null {
    return this.addButton;
  }
  // ------------------------------------------
  handleClickButton(): void {
    if (window.location.pathname.includes("candidat")) {
      this.setPath(
        window.location.pathname.slice(1, window.location.pathname.length)
      );
      this.setRessourceIdKey("id_candidat");

      this.setCandidatModalFactory(new CandidatModalFactory());
      if (this.addButton) {
        this.addButton.addEventListener("click", () => {
          this.setModalType(ModalType.Create);
          this.setCandidatModal(
            this.candidatModalFactory.createModal(this.modalType)
          );
          this.candidatModal.show();
        });
      }
      if (this.editButtons) {
        this.editButtons.forEach((editButton) => {
          editButton.addEventListener("click", async (ev) => {
            ev.preventDefault();
            const targetElement = ev.target as HTMLElement;

            this.setModalType(ModalType.Update);

            try {
              this.setRowId(parseInt(targetElement.dataset.id!, 10));

              await this.get().then((res) => {
                if (res.status === 200) {
                  this.candidatModalFactory.setCandidatData(res.data.data[0]);
                }
              });
            } catch (error) {
              throw new Error("can not get candidat data");
            }

            this.setCandidatModal(
              this.candidatModalFactory.createModal(this.modalType)
            );
            this.candidatModal.show();
          });
        });
      }
      if (this.deleteButtons) {
        this.deleteButtons.forEach((deleteButton) => {
          deleteButton.addEventListener("click", async (ev) => {
            ev.preventDefault();
            const targetElement = ev.target as HTMLElement;
            this.setModalType(ModalType.Delete);
            try {
              this.setRowId(parseInt(targetElement.dataset.id!, 10));

              await this.get().then((res) => {
                if (res.status === 200) {
                  this.candidatModalFactory.setCandidatData(res.data.data[0]);
                }
              });
            } catch (error) {
              throw new Error("can not get candidat data");
            }
            this.setCandidatModal(
              this.candidatModalFactory.createModal(this.modalType)
            );
            this.candidatModal.show();
          });
        });
      }
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
}

const app = new App();
