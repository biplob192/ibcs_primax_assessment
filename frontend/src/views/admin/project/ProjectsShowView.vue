<template>
  <v-card style="margin: auto" class="mt-5 pa-5">
    <v-row class="mb-2">
      <v-col cols="12" md="8">
        <h3><strong>Project:</strong> {{ project.title }}</h3>
        <p class="text-justify">
          <strong>Description:</strong> {{ project.description }}
        </p>
      </v-col>

      <v-col cols="12" md="4">
        <p class="mb-5">
          <strong
            >Project Tast List:
            <span style="color: red">[Handler added in console]</span>
          </strong>
        </p>
        <div ref="sortableContainer">
          <v-card v-for="task in project_tasks" :key="task.id" class="mb-1">
            <v-card-text>
              <v-icon class="drag-handle">mdi-drag</v-icon>
              {{ task.title }}
            </v-card-text>
          </v-card>
        </div>
      </v-col>
    </v-row>

    <v-row class="mt-1 mb-3">
      <v-col cols="12" sm="12" md="8"> </v-col>
      <v-col cols="12" sm="12" md="4" class="text-right">
        <v-text-field
          v-model="formData.title"
          label="Enter New Task"
          required
        ></v-text-field>
        <v-btn @click="handleNewTask">Add New Task</v-btn>
      </v-col>
    </v-row>
  </v-card>
</template>

<script>
import { mapState, mapGetters, mapActions } from "vuex";
import Sortable from "sortablejs";
import axios from "axios";

export default {
  components: {},

  data() {
    return {
      formData: {
        title: "",
      },
      errors: {},
    };
  },

  created() {},

  mounted() {
    if (this.logged_in) {
    }
    this.getProject(this.$route.params.id);
    this.getProjectTasks(this.$route.params.id);

    // Sortable.js
    const container = this.$refs.sortableContainer;
    const sortable = new Sortable(container, {
      animation: 150,
      // Event callbacks
      onEnd: (evt) => {
        // This event fires when sorting ends
        // You can access the updated order using `evt.newIndex` and `evt.oldIndex`
        // Example:
        console.log(
          `Moved item from index ${evt.oldIndex} to index ${evt.newIndex}`
        );

        // If you want to update the order in your Vuex store or API, you can do it here.
        // Dispatch an action to update the task order, for example:
        // this.updateTaskOrder(evt.oldIndex, evt.newIndex);
      },
    });
  },

  computed: {
    ...mapState("project", ["success_message", "project", "project_tasks"]),

    ...mapGetters({
      logged_in: "loginStatus",
      user_role: "userRole",
    }),
  },

  methods: {
    ...mapActions("project", [
      "getProject",
      "getProjectTasks",
      "storeProjectTask",
    ]),

    handleNewTask: async function () {
      let formData = new FormData();
      formData.append("title", this.formData.title);
      formData.append("project_id", this.$route.params.id);

      try {
        let info = await this.storeProjectTask(formData);
        let response = JSON.parse(info);

        if (response.status == 201) {
          alert(response.data.message);

          this.formData.title = "";
          this.getProjectTasks(this.$route.params.id);
        }
      } catch (e) {
        alert(e.response.data.message);
      }
    },
  },
};
</script>

<style scoped>
.drag-handle {
  cursor: grab;
  margin-right: 10px;
}
</style>
