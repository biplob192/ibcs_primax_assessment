import ProjectsIndex from "../../views/admin/project/ProjectsIndexView.vue";
import ProjectsCreate from "../../views/admin/project/ProjectsCreateView.vue";
import ProjectsEdit from "../../views/admin/project/ProjectsEditView.vue";
import ProjectsShow from "../../views/admin/project/ProjectsShowView.vue";

export default [
  {
    path: "/projects",
    name: "ProjectsIndex",
    component: ProjectsIndex,
  },

  {
    path: "/projects/create",
    name: "ProjectsCreate",
    component: ProjectsCreate,
  },

  {
    path: "/projects/:id",
    name: "ProjectsShow",
    component: ProjectsShow,
  },

  {
    path: "/projects/:id/edit",
    name: "ProjectsEdit",
    component: ProjectsEdit,
  },
];
