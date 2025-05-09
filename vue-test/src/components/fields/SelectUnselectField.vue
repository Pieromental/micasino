<template>
  <div class="select-unselect-container">
    <div v-for="column in columns" :key="column.label" class="options-column">
      <h3>{{ column.label }}</h3>
      <ul class="options-list">
        <li
          v-for="option in column.options"
          :key="option.id"
          @click="toggleOption(option, column.type)"
          class="option-item"
        >
          {{ option.label }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";

const props = defineProps({
  field: Object,
  modelValue: {
    type: Array,
    default: () => [],
  },
});

const emit = defineEmits(["update"]);

const availableOptions = ref([]);
const disabledOptions = ref([]);

const columns = computed(() => [
  {
    label: "Available Options",
    options: availableOptions.value,
    type: "available",
  },
  {
    label: "Disabled Options",
    options: disabledOptions.value,
    type: "disabled",
  },
]);

const initOptions = () => {
  const allOptions = props.field.options;
  disabledOptions.value = allOptions.filter((opt) =>
    props.modelValue.includes(opt.id)
  );
  availableOptions.value = allOptions.filter(
    (opt) => !props.modelValue.includes(opt.id)
  );
};

const toggleOption = (option, from) => {
  if (from === "available") {
    availableOptions.value = availableOptions.value.filter(
      (o) => o.id !== option.id
    );
    disabledOptions.value.push(option);
  } else {
    disabledOptions.value = disabledOptions.value.filter(
      (o) => o.id !== option.id
    );
    availableOptions.value.push(option);
  }

  emit("update", {
    id: props.field.id,
    value: disabledOptions.value.map((o) => o.id),
  });
};
onMounted(() => {
  initOptions();
});
</script>

<style scoped>
.select-unselect-container {
  display: flex;
  gap: 10px;
  margin-bottom: 15px;
  width: 100%;
}

.options-column {
  border: 1px solid #444;
  padding: 10px;
  width: 50%;
  background: black;
  border-radius: 0;
}

.options-column h3 {
  margin-top: 0;
  margin-bottom: 10px;
  font-size: 14px;
  color: #fff;
  text-align: center;
  font-weight: normal;
}

.options-list {
  list-style: none;
  padding: 0;
  margin: 0;
  min-height: 80px;
  max-height: 120px;
  overflow-y: auto;
}

.option-item {
  cursor: pointer;
  padding: 5px 10px;
  border-bottom: 1px solid #444;
  color: #fff;
}

.option-item:hover {
  background-color: #444;
}

.option-item:last-child {
  border-bottom: none;
}
</style>
