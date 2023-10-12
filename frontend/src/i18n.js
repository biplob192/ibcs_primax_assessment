// i18n.js
import { createI18n } from 'vue-i18n';

const messages = {
  en: {
    message: {
      hello: 'Hello, world!',
    },
    title: {
        home_page: 'Home page content',
    }
  },
  bn: {
    message: {
      hello: 'হ্যালো, বিশ্ব!',
    },
    title: {
        home_page: 'হোম পেজ কন্টেন্ট',
    }
  },
};

const i18n = createI18n({
  locale: 'en', // Set your default locale
  fallbackLocale: 'en',
  messages,
});

export default i18n;
