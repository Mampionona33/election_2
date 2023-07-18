import * as bootstrap from "bootstrap";
// import TableCandidatHandler from "./js/TableCandidatHandler";
import { ModalType } from "./js/modal/ModalType";
import { CandidatModalFactory } from "./js/modal/CandidatModalFactory"; // Import CandidatModalFactory ici

class App {
  private addButton: Element | null;

  constructor() {
    this.addButton = document.getElementById("table-btn-add");
    this.handleClickAdd();
  }

  /**
   * Getter and Setter
   */
  public setAddButton(addButton: Element | null): void {
    this.addButton = addButton;
  }

  public getAddButton(): Element | null {
    return this.addButton;
  }

  handleClickAdd(): void {
    if (window.location.pathname.includes("candidat")) {
      if (this.addButton) {
        this.addButton.addEventListener("click", () => {
          const type = ModalType.Create;
          const modalFactory = new CandidatModalFactory(); // Utilisez new CandidatModalFactory() pour créer l'instance de la fabrique de modal
          const modal = modalFactory.createModal(type);
          modal.show();
        });
      }
    }
  }
}

const app = new App();
