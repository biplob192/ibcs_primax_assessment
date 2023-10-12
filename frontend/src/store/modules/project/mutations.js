export const SET_PROJECTS = (state, response) => {
  state.projects = response.data;
  // state.projects = response.data.data;
};

export const SET_PROJECTS_GET_DATA = (state, response) => {
  state.users = response.data.data;
};

export const SET_PROJECT = (state, response) => {
  state.project = response.data;
};

export const SET_PROJECT_TASKS = (state, response) => {
  state.project_tasks = response.data;
};

export const ADD_PROJECT = (state, response) => {
  if (state.projects.push(response.data.data)) {
    state.success_message = response.data.message;
  } else {
    state.success_message = "";
  }
};

export const ADD_PROJECT_TASK = (state, response) => {
  if (state.project_tasks.push(response.data.data)) {
    state.success_message = response.data.message;
  } else {
    state.success_message = "";
  }
};

export const UPDATE_PROJECT = (state, response) => {
  const index = state.users.findIndex(
    (user) => user.id === response.data.data.id
  );

  if (index !== -1) {
    if (state.users.splice(index, 1, response.data.data)) {
      state.success_message = response.data.message;
    } else {
      state.success_message = "";
    }
  }
};

export const DELETE_PROJECT = (state, response) => {
  var id = response.id;
  if (id) {
    state.projects = state.projects.filter((item) => {
      return id !== item.id;
    });

    state.success_message = response.data.message;
  } else {
    state.success_message = "";
  }
};
