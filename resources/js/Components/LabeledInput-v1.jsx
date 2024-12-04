import { InputContainer } from "@/Components/InputContainer.jsx";
import { InputLabel } from "@/Components/InputLabel.jsx";
import { InputField } from "@/Components/InputField.jsx";


export function LabeledInput({ id, value, onChange, color, thickness, children}) {
    return (
        <InputContainer>
            <InputLabel
                labelFor={id}
                color={color}
                thickness={thickness}
            >
                {children}
            </InputLabel>
            <InputField id={id} value={value} onChange={onChange}>
                {children}
            </InputField>
        </InputContainer>
    );
}
