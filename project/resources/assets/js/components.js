import DatePicker from 'vuejs-datepicker';

/** Components */
Vue.component("data-list", require('@/components/data-list/DataList.vue'));
Vue.component("search", require('@/components/data-list/Search.vue'));
Vue.component("loader", require('@/components/data-list/Loader.vue'));

Vue.component("breadcrumb", require('@/components/breadcrumb/Breadcrumb.vue'));
Vue.component("breadcrumb-item", require('@/components/breadcrumb/BreadcrumbItem.vue'));
Vue.component("approve-buttons", require('@/components/buttons/ApproveButtons.vue'));

Vue.component('address-component', require('@/components/AddressComponent.vue'));

Vue.component('meal-modal', require('@/components/MealModal.vue'));

Vue.component('datepicker', DatePicker);

Vue.component('filter-date', require('@/components/filters/Date.vue'));

Vue.component('import-spreadsheet', require('@/components/ImportSpreadsheet.vue'));

Vue.component('admin-dashboard', require('@/components/AdminDashboard.vue'));