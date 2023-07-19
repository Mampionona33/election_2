import { IModal } from "./IModal";
import { ModalBase } from "./ModalBase";
import { CandidatModalCreate } from "./CandidatModalCreate";

export class CandidatModalUpdate extends ModalBase implements IModal {
  private candidatData: object;
  protected rowId: number;
  /**
   * Getter and setter
   */
  public setRowId(rowId: number) {
    this.rowId = rowId;
  }
  public getRowId(): number {
    return this.rowId;
  }
  public setCandidatData(candidatData: object) {
    this.candidatData = candidatData;
  }

  public getCandidatData(): object {
    return this.candidatData;
  }
  // -------------------------------
  constructor(candidatData) {
    super();
    this.setCandidatData(candidatData);
    this.setModalTitle("Modifier candidat");
    this.setModalBody(this.generateModalBody());
    this.setSubmitLabel("Modifier");
    this.setPath(
      window.location.pathname.slice(1, window.location.pathname.length)
    );
    this.setHandleSubmit(this.handleUpdate);
  }

  private generateModalBody(): string {
    console.log(this.candidatData);

    return `
        <div class="form-group row">
        <label for="name" class="col-sm-6 col-form-label">Nom</label>
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-sm" name="name" id="name" value="${this.candidatData["name"]}" required>
        </div>
        </div>
        <div class="form-group row">
        <label for="nb_voix" class="col-sm-6 col-form-label">Nombre de voix</label>
        <div class="col-sm-6">
            <input type="number" class="form-control form-control-sm" name="nb_voix" id="nb_voix" value="${this.candidatData["nb_voix"]}" required>
        </div>
        </div>
        `;
  }

  private async handleUpdate(ev: Event) {
    ev.preventDefault();
    const form = ev.target as HTMLFormElement;
    const formData = new FormData(form);
    const data: any = {}; // Use 'any' type to allow dynamic property assignment

    for (const [key, value] of formData.entries()) {
      if (typeof value === "string") {
        data[key] = value;
      }
    }
    // Add the id_candidat property to the data object
    if (this.candidatData && "id_candidat" in this.candidatData) {
      data["id_candidat"] = this.candidatData["id_candidat"];
    }
    const resp = await this.put(data);

    if (resp.status === 200) {
      window.location.reload();
    }
  }

  /**
   * method for fetch and post data
   */

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
