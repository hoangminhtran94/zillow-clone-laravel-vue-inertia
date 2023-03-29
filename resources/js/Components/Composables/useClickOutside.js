const useClickOutSide = (elementRef, openRef) => {
    const clickHandler = (event) => {
        if (!elementRef.value.contains(event.target)) {
            openRef.value = false;
        } else {
            openRef.value = true;
        }
    };

    window.addEventListener("click", clickHandler);
};

export default useClickOutSide;
