import Project from "../../../services/api/ProjectApi";

export const getProjects = ({ commit }) => {
  return Project.all().then((response) => {
    commit("SET_PROJECTS", response.data);

    return JSON.stringify(response);
  });
};

// export const getProjectsData = ({ commit }, params) => {
//   return Project.getData(params).then((response) => {
//     commit("SET_USERS_GET_DATA", response.data);

//     return JSON.stringify(response);
//   });
// };

export const getProject = ({ commit }, id) => {
  Project.show(id).then((response) => {
    commit("SET_PROJECT", response.data);
  });
};

export const getProjectTasks = ({ commit }, id) => {
  Project.getProjectTasks(id).then((response) => {
    commit("SET_PROJECT_TASKS", response.data);
  });
};

export const storeProject = ({ commit, dispatch, rootState }, data) => {
  return Project.store(data).then((response) => {
    var data = response.data;
    commit("ADD_PROJECT", { data });

    return JSON.stringify(response);
  });
};

export const storeProjectTask = ({ commit, dispatch, rootState }, data) => {
  return Project.storeProjectTask(data).then((response) => {
    var data = response.data;
    commit("ADD_PROJECT_TASK", { data });

    return JSON.stringify(response);
  });
};

// export const updateUser = ({ commit }, data) => {
//   return User.update(data["0"], data["1"]).then((response) => {
//     var data = response.data;
//     commit("UPDATE_USER", { data });

//     return JSON.stringify(response);
//   });
// };

export const deleteProject = ({ commit }, id) => {
  return Project.delete(id).then((response) => {
    commit("DELETE_PROJECT", { id: id, data: response.data });

    return JSON.stringify(response);
  });
};

// export const exportUsers = () => {
//   return User.export().then((response) => {
//     const url = window.URL.createObjectURL(new Blob([response.data]));
//     const link = document.createElement('a');

//     link.href = url;
//     link.setAttribute('download', 'users.xlsx');
//     document.body.appendChild(link);

//     link.click();
//     document.body.removeChild(link);
//   });
// };
