import { IModal } from "./IModal";

export abstract class ModalFactory {
    abstract createModal(type: string): IModal;
}
