import * as bootstrap from "bootstrap";
import TableCandidatHandler from "./js/TableCandidatHandler";
console.log("Hello World!");

if (window.location.pathname.includes("candidat")) {
  const tableCandidatHandler = new TableCandidatHandler();
}
