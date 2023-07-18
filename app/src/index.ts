import * as bootstrap from "bootstrap";
// import TableCandidatHandler from "./js/TableCandidatHandler";
import { ModalType } from "./js/modal/ModalType";
import { CandidatModalFactory } from "./js/modal/CandidatModalFactory"; // Import CandidatModalFactory ici
import { IModal } from "./js/modal/IModal";

class App {
  private addButton: Element | null;
  private editButtons: NodeListOf<Element> | null;
  private modalType: ModalType;
  private candidatModalFactory: CandidatModalFactory;
  private candidatModal: IModal;

  constructor() {
    this.addButton = document.getElementById("table-btn-add");
    this.setEditButtons(document.querySelectorAll('button[name="edit"]'));
    this.handleClickButton();
  }

  /**
   * Getter and Setter
   */
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
  public getEditButtons(): NodeListOf<Element> | null {
    return this.editButtons;
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
          editButton.addEventListener("click", (ev) => {
            ev.preventDefault();
            console.log(ev.target);
            const targetElement = ev.target as HTMLElement;

            this.setModalType(ModalType.Update);

            this.candidatModalFactory.setRowId(
              parseInt(targetElement.dataset.id!, 10)
            );
            this.setCandidatModal(
              this.candidatModalFactory.createModal(this.modalType)
            );

            this.candidatModal.show();
          });
        });
      }
    }
  }
}

const app = new App();
