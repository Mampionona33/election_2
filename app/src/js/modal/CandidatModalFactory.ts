import { IModal } from "./IModal";
import { ModalFactory } from "./ModalFactory";
import { CandidatModalCreate } from "./CandidatModalCreate";
import { ModalType } from "./ModalType";

export class CandidatModalFactory extends ModalFactory {
  createModal(type: ModalType): IModal {
    switch (type) {
      case ModalType.Create:
        return new CandidatModalCreate();
        break;
      default:
        throw new Error("Type de modal non pris en charge.");
        break;
    }
  }
}
