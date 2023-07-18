import { Modal } from "bootstrap";
import { IModal } from "./IModal";
import { ModalBase } from "./ModalBase";

export class CandidatModalCreate extends ModalBase implements IModal {
  private path: string;

  /**
   * Getter and setter
   * @param path
   */
  public setPath(path: string): void {
    this.path = path;
  }
  public getPath(): string {
    return this.path;
  }
  // ----------------------------
  constructor() {
    super();
    this.setModalTitle("Créer candidat");
    this.setModalBody(this.generateModalBody());
    this.setSubmitId("submit_modal_create");
    this.setSubmitLabel("Créer");
    this.setHandleSubmit(this.handleCreate);
    this.setPath(
      window.location.pathname.slice(1, window.location.pathname.length)
    );
  }

  private generateModalBody(): string {
    return `
    <div class="form-group row">
      <label for="name" class="col-sm-6 col-form-label">Nom</label>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-sm" name="name" id="name" value="" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="nb_voix" class="col-sm-6 col-form-label">Nombre de voix</label>
      <div class="col-sm-6">
        <input type="number" class="form-control form-control-sm" name="nb_voix" id="nb_voix" value="" required>
      </div>
    </div>
    `;
  }

  private async handleCreate(ev: Event) {
    ev.preventDefault();
    ev.preventDefault();
    const form = ev.target as HTMLFormElement;
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());
    console.log(data);
    const resp = await this.post(data);
    if (resp.status === 200) {
      console.log(resp);
      window.location.reload();
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
}
