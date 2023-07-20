import { IModal } from "./IModal";
import { ModalBase } from "./ModalBase";

export class CandidatModalDelete extends ModalBase implements IModal {
  private candidatData: object;

  /**
   * getter and setter
   */

  public setCandidatData(candidatData: object) {
    this.candidatData = candidatData;
  }

  public getCandidatData(): object {
    return this.candidatData;
  }

  constructor(candidatData: object) {
    super();
    this.setCandidatData(candidatData);
    this.setModalTitle("Supprimer candidat");
    this.setSubmitLabel("Supprimer");
    this.setModalBody(this.generateModalBody());
    this.setPath(
      window.location.pathname.slice(1, window.location.pathname.length)
    );
    this.setHandleSubmit(this.handleDelete);
  }
  private generateModalBody(): string {
    console.log(this.candidatData);

    return `
        <div class="form-group row">
          <div class="">
            Êtes-vous sûr de vouloir supprimer le candidat ${this.candidatData["name"]} ?
          </div>
        </div>
        `;
  }

  private async handleDelete(ev: Event) {
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
    console.log(data);
    const resp = await this.delete(data);

    if (resp.status === 200) {
      window.location.reload();
    }
  }

  async delete(data: object): Promise<{ status: number; data: any }> {
    try {
      const response = await fetch(`api/${this.path}`, {
        method: "DELETE",
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
