<div class="crud-form-field">
    <div class="crud-form-field-label">
        <x-rambo::crud.form.label :field="$field" />
    </div>

    <div class="crud-form-field-input">
        <livewire:page-architect-livewire-field
            :key="$field->getName()"
            :field="$field"
        />

        <x-rambo::crud.form.error :field="$field" />
    </div>
</div>
