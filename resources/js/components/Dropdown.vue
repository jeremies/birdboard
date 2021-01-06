<template>
    <div class="dropdown relative">
        <div @click="isOpen = !isOpen">
            <slot name="trigger"></slot>
        </div>

        <div v-show="isOpen" class="dropdown-menu absolute bg-card py-2 rounded shadow mt-2"
             :class="align === 'left' ? 'left-0' : 'right-0'"
             :style="{ width }">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        width: {default: 'auto'},
        align: {default: 'left'}
    },

    watch: {
        isOpen(isOpen) {
            if (isOpen) {
                document.addEventListener('click', this.closeIfClickedOutside);
            }
        }
    },

    data() {
        return {isOpen: false}
    },

    methods: {
        closeIfClickedOutside(event) {
            if (!event.target.closest('.dropdown')) {
                this.isOpen = false;

                document.removeEventListener('click', this.closeIfClickedOutside);
            }
        }
    }
}
</script>
