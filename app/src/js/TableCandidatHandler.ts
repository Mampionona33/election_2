import { CustomTableHandler } from "./CustomTableHandler";

class TableCandidatHandler extends CustomTableHandler {
  constructor() {
    super();
    const addButton = document.querySelector("#table-btn-add");
    if (addButton instanceof HTMLButtonElement) {
      console.log(addButton);

      this.setAddButton(addButton);
      this.handleClickAdd();
    } else {
      console.log("no ok");
    }
  }
}

export default TableCandidatHandler;
