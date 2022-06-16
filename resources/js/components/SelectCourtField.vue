<template>
    <select class="form-control" id="court" name="courts_id" required
        >
        <option value="" disabled>
            -- select court --
        </option>
        <option v-for="court in courts" :value="[court.id, court.name]">
            {{ court.name }}
        </option>
    </select>
</template>
<script>
export default {
    props: [
        'courts'
    ]
}
</script>
