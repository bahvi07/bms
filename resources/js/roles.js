import { setupImport } from "./utils/importHandler";
import { getCsrfToken } from "./main";
setupImport({
    importBtnId: "importRoleBtn",
    importModalId: "importRoleModal",
    importFormId: "importRoleForm",
    importSubmitBtnId: "importRoleSubmitBtn",
    endpoint: "/dashboard/roles/import-roles",
    entityName: "roles"
});