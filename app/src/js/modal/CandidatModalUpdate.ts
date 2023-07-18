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
  constructor(rowId) {
    super();
    this.setRowId(rowId);
    this.setModalTitle("Modifier candidat");
    this.setModalBody(this.generateModalBody());
    this.setSubmitLabel("Modifier");
    this.setPath(
      window.location.pathname.slice(1, window.location.pathname.length)
    );
  }

  private generateModalBody(): string {
    console.log(this.rowId);
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

  //   async get(): Promise<{ status: number; data: any }> {
  //     try {
  //       const res = await fetch(
  //         `api/${this.path}?${this.ressourceIdKey}=${this.rowId}`
  //       );
  //       if (!res.ok) {
  //         throw new Error("Unable to fetch data from API.");
  //       }
  //       const data = await res.json();
  //       return {
  //         status: res.status,
  //         data,
  //       };
  //     } catch (error) {
  //       throw error;
  //     }
  //   }
}
