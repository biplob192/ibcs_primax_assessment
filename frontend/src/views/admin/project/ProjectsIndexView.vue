<template>
  <v-data-table
    v-model:items-per-page="itemsPerPage"
    :headers="headers"
    :items="projects"
    :sort-by="[{ key: 'title', order: 'asc' }]"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat>
        <v-toolbar-title>PROJECTS</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ props }">
            <!-- <v-btn color="primary" dark class="mb-2" v-bind="props">
              New Projects
            </v-btn> -->
            <router-link to="/projects/create">
              <v-btn>New Project</v-btn>
            </router-link>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12">
                    <v-text-field
                      v-model="editedItem.title"
                      label="Title"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-textarea
                      v-model="editedItem.description"
                      label="Description"
                    ></v-textarea>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.start_date"
                      label="Start Date"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.end_date"
                      label="End Date"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue-darken-1" variant="text" @click="close">
                Cancel
              </v-btn>
              <v-btn color="blue-darken-1" variant="text" @click="save">
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5"
              >Are you sure you want to delete this item?</v-card-title
            >
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue-darken-1" variant="text" @click="closeDelete"
                >Cancel</v-btn
              >
              <v-btn
                color="blue-darken-1"
                variant="text"
                @click="deleteItemConfirm"
                >OK</v-btn
              >
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon size="small" class="me-2" @click="showItem(item.raw)">
        mdi-eye
      </v-icon>
      <v-icon size="small" class="me-2" @click="editItem(item.raw)">
        mdi-pencil
      </v-icon>
      <v-icon size="small" @click="deleteItem(item.raw)"> mdi-delete </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize"> Reset </v-btn>
    </template>
  </v-data-table>
</template>
<script>
import { VDataTable } from "vuetify/labs/VDataTable";
import { VDataTableServer } from "vuetify/labs/VDataTable";
import { mapState, mapGetters, mapActions } from "vuex";
import axios from "axios";

export default {
  components: {
    VDataTable: VDataTable,
    VDataTableServer: VDataTableServer,
  },

  data: () => ({
    itemsPerPage: 5,
    dialog: false,
    dialogDelete: false,
    headers: [
      { title: "Title", key: "title", width: "20%", sortable: false },
      { title: "Description", key: "description", width: "50%" },
      { title: "Start Date", key: "start_date", width: "10%" },
      { title: "End Date", key: "end_date", width: "10%" },
      { title: "Actions", key: "actions", sortable: false },
    ],
    // projects: [],
    editedIndex: -1,
    editedItem: {
      title: "",
      description: "",
      start_date: "",
      end_date: "",
    },
    defaultItem: {
      title: "",
      description: "",
      start_date: "",
      end_date: "",
    },
  }),

  created() {
    // this.getProjects();
  },

  mounted() {
    if (this.logged_in) {
    }
    this.getProjects();
  },

  computed: {
    // Import states
    ...mapState("project", ["success_message", "projects"]),
    ...mapState(["baseUrl"]),

    // Import getters
    ...mapGetters({
      logged_in: "loginStatus",
      user_role: "userRole",
    }),

    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  methods: {
    ...mapActions("project", ["getProjects", "deleteProject"]),

    initialize() {
      this.getProjects();
    },

    showItem(item) {
      this.editedIndex = this.projects.indexOf(item);
      // this.editedItem = Object.assign({}, item);
      // this.dialog = true;

      var projectID = this.projects[this.editedIndex].id;

      this.$router.push({ name: "ProjectsShow", params: { id: projectID } });
    },

    editItem(item) {
      this.editedIndex = this.projects.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;

      console.log(this.projects[this.editedIndex].id);
    },

    deleteItem(item) {
      this.editedIndex = this.projects.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;

      console.log(this.projects[this.editedIndex].id);
    },

    deleteItemConfirm() {
      // this.projects.splice(this.editedIndex, 1);
      // this.closeDelete();

      this.handleDeleteProject(this.projects[this.editedIndex].id);
      this.closeDelete();
      this.getProjects();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.projects[this.editedIndex], this.editedItem);
      } else {
        this.projects.push(this.editedItem);
      }
      this.close();
    },

    handleDeleteProject: async function (id) {
      try {
        let info = await this.deleteProject(id);
        let response = JSON.parse(info);

        if (response.status == 200) {
          alert(this.success_message);
        }
      } catch (e) {
        alert(e.response.data.message);
      }
    },
  },
};
</script>

<style scoped>
.answer {
  font-weight: bold;
  color: orangered;
}

a:hover {
  color: orangered;
  text-decoration: underline;
}

a {
  display: inline-block;
  font-size: 14px;
  text-decoration: none;
  /* padding: 5px;
    margin: 5px; */
  border-left: 1px solid var(--color-border);
}

.post_title {
  font-size: 21px;
  text-decoration: none;
  margin: 5px;
  cursor: pointer;
}

.post_title:hover {
  color: orangered;
  text-decoration: underline;
}
</style>
