import { CustomTableHandler } from "./CustomTableHandler";

class TableCandidatHandler extends CustomTableHandler {
  constructor() {
    super();
    const addButton = document.querySelector("#table-btn-add");
    if (addButton instanceof HTMLButtonElement) {
      this.setAddButton(addButton);
      this.handleClickAdd();
    } 
    const modalForm = this.generateModalForm();
    this.setModalForm(modalForm);
    this.setModalAddtitle("Créer candidat");
  }

  private generateModalForm(data?: { name: string; nb_voix: number } | null): string {
    return `
    <div class="form-group row">
      <label for="name" class="col-sm-6 col-form-label">Nom</label>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-sm" name="name" id="name" value="${
          data?.name ? data.name : ""
        }" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="nb_voix" class="col-sm-6 col-form-label">Nombre de voix</label>
      <div class="col-sm-6">
        <input type="number" class="form-control form-control-sm" name="nb_voix" id="nb_voix" value="${
          data?.nb_voix ? data.nb_voix : ""
        }" required>
      </div>
    </div>
    `;
  }
}

export default TableCandidatHandler;
