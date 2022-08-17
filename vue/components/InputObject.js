export default {
    template: `
        <div class="mb-4">
            <label class="form-label" :for="title">{{label}} <span class="input-required">*</span></label>
            <input class="form-control" :type="type" :name="title" :id="title" v-model="value">
        </div>
    `,

    data() {
        return {
            type: "text",
            value: "",
            title: "",
            label: ""
        }
    },

}