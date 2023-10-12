<template>
  <v-row class="mb-2 mt-1">
    <v-col cols="12" md="9">
      <div>
        <h2>{{ $t("title.home_page") }}</h2>
      </div>
    </v-col>

    <v-col cols="12" md="3">
      <div>
        <v-select
          label="Select language"
          v-model="select"
          @update:modelValue="changeSelectedLanguage"
          :hint="`${select.text}, ${select.value}`"
          :items="items"
          item-title="text"
          item-value="value"
          persistent-hint
          return-object
        ></v-select>
      </div>
    </v-col>
  </v-row>
</template>
<script>
import { mapState, mapGetters, mapActions } from "vuex";

export default {
  name: "HomeView",

  data() {
    return {
      base_url: this.$store.state.baseUrl,
      access_token_local: localStorage.getItem("access_token"),

      select: { text: "English", value: "en" },
      items: [
        { text: "English", value: "en" },
        { text: "Bengali", value: "bn" },
      ],
    };
  },

  computed: {
    ...mapGetters({
      logged_in: "loginStatus",
    }),
  },

  mounted() {
    if (this.logged_in) {
      this.getUserInfo();
    }
  },

  methods: {
    ...mapActions("admin", ["getUserInfo"]),

    changeSelectedLanguage() {
      this.$i18n.locale = this.select.value;
    },
  },
};
</script>
