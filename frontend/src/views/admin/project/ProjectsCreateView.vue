<template>
  <v-card width="70%" style="margin: auto" class="mt-5 pb-5">
    <div style="width: 100%; margin: auto; padding: 15px">
      <h2>New Project</h2>
    </div>

    <div style="width: 100%; margin: auto; background: #fffae8; padding: 15px">
      <form v-on:submit.prevent="">
        <v-text-field
          v-model="formData.title"
          label="Title"
          required
        ></v-text-field>

        <v-textarea
          v-model="formData.description"
          label="Description"
        ></v-textarea>

        <v-row class="mb-2">
          <v-col cols="12" md="6">
            Select Start Date:
            <input label="Start" type="date" v-model="formData.start_date" />
          </v-col>

          <v-col cols="12" md="6">
            Select End Date:
            <input label="End" type="date" v-model="formData.end_date" />
          </v-col>
        </v-row>

        <v-btn class="me-4" @click="handleNewProject"> submit </v-btn>
        <router-link to="/projects">
          <v-btn> Project List </v-btn>
        </router-link>
      </form>
    </div>
  </v-card>
</template>

<script>
import { mapState, mapActions } from "vuex";
import { VDatePicker } from "vuetify/labs/VDatePicker";

export default {
  name: "CreateProjectView",
  components: {
    VDatePicker,
  },
  data() {
    return {
      formData: {
        title: "",
        description: "",
        start_date: null,
        end_date: null,
      },
      errors: {},
    };
  },

  methods: {
    ...mapActions("project", ["storeProject"]),

    handleNewProject: async function () {
      let formData = new FormData();
      formData.append("title", this.formData.title);
      formData.append("description", this.formData.description);
      formData.append("start_date", this.formData.start_date);
      formData.append("end_date", this.formData.end_date);

      try {
        let info = await this.storeProject(formData);
        let response = JSON.parse(info);

        if (response.status == 201) {
          alert(response.data.message);

          this.formData.title = "";
          this.formData.description = "";
          this.formData.start_date = null;
          this.formData.end_date = null;
        }
      } catch (e) {
        alert(e.response.data.message);
      }
    },
  },
};
</script>

<style scoped>
a:hover {
  color: orangered;
  text-decoration: underline;
}
</style>
