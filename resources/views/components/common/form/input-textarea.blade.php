 @props([
 'name',
 'placeholder',
 'value' => '',
 'label'
 ])
 <div class="input-textarea">
     <label for="{{ $name }}">{{ $label }}</label>
     <textarea class="input-textarea-input" name="{{ $name }}" rows="5" cols="50" placeholder="{{ $placeholder }}">{{ $value != ''? $value : old($name) }}</textarea>
     @error($name)
     <span style="color: #f81a1a;">{{ $message }}</span>
     @enderror
 </div>