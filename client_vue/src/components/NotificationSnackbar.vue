<template>
    <div>
        <v-snackbar
            v-model="isVisible"
            :timeout="-1"
            bottom
            :color="color"
            right
        >
            <div
                class="font-weight-medium"
            >
                {{ text }}
            </div>
            <template v-slot:action="{ attrs }">
                <v-btn
                    color="free"
                    text
                    fab
                    icon
                    v-bind="attrs"
                    @click="isVisible = false"
                >
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </template>
        </v-snackbar>
    </div>
</template>

<script>
export default {
    props: {
        isVisible: {
            type: Boolean,
            default: false,
        },
        text: {
            type: String,
            default: '',
        },
        color: {
            type: String,
            default: 'green',
        }
    }
}
</script>
