import { CustomTableHandler } from "./CustomTableHandler";

class TableCandidatHandler extends CustomTableHandler {
  constructor() {
    super("id_candidat");
    if (document.querySelector("#table-btn-add")) {
      this.setAddButton(document.querySelector("#table-btn-add"));
      this.handleClickAdd();
    }
    if (document.querySelectorAll('button[name="edit"]')) {
      document.querySelectorAll('button[name="edit"]').forEach((editButton) => {
        this.setEditButton(editButton);
        this.handleClickEdit();
      });
    }
    this.setModalForm(this.generateModalForm);
    this.setModalAddtitle("Créer candidat");
    this.setModalEditTitle("Modifier candidat");
  }

  private generateModalForm(
    data?: { name: string; nb_voix: number } | null
  ): string {
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
