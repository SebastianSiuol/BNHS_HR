export function capitalizeFirstLetter(text) {
  const word = text
      ?.split(" ")
      .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
      .join(" ");

  return word;
}