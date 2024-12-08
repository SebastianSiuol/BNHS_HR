export function NavStepper({ header, index, step }) {
    const isActive = index === step;

    const listItemClass =
        "flex items-center space-x-2.5 rtl:space-x-reverse rounded-full shrink-0 ";
    const spanLabelClass =
        "flex items-center justify-center w-8 h-8 border rounded-full shrink-0 ";

    return (
        <li
            className={
                listItemClass + (isActive ? " text-blue-600" : " text-gray-500")}
        >
            <span
                className={
                    spanLabelClass + (isActive ? "  border-blue-600" : " border-gray-500")}
            >
                {index + 1}
            </span>
            <span>
                <h3 className={"font-medium leading-tight"}>{header}</h3>
            </span>
        </li>
    );
}