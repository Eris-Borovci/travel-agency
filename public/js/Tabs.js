// main-tab-container
// tabs

document.addEventListener("alpine:init", () => {
    Alpine.data("tabs", () => ({
        tabs: [],
        activeTabName: {},
        addTabs(newTabs, activeTabName) {
            this.activeTabName = activeTabName;

            newTabs.forEach((nt) => {
                this.addTab(nt);
            });

            this.initTab("main-tab-container");
        },
        addTab(newTab) {
            this.tabs.push(newTab);
        },
        changeActiveTab(tabName = null) {
            // Removing the active classes to previous tab
            const previousTab = document.querySelector(".active");
            const previousIcon = document.querySelector(".active i");

            // Checking if the previous tab is same as the new active tab;
            if (previousTab != null) {
                if (this.activeTabName == `tab-${tabName}`) {
                    return;
                } else {
                    previousTab.classList.remove(
                        "!border-blue-600",
                        "!text-blue-600",
                        "active"
                    );
                    previousIcon.classList.remove(
                        "!text-blue-600",
                        "!group-hover:text-blue-500"
                    );
                }
            }

            // Adding the active classes to selected tabs
            const theTab = document.querySelector(`#tab-${tabName} div`);
            const theTabIcon = document.querySelector(
                `#tab-${tabName} > div > i`
            );

            theTab.classList.add(
                "!border-blue-600",
                "!text-blue-600",
                "active"
            );
            theTabIcon.classList.add(
                "!text-blue-600",
                "!group-hover:text-blue-500"
            );

            for (let i = 0; i < this.tabs.length; i++) {
                const tab = this.tabs[i];
                if (tab.name == tabName) {
                    document
                        .querySelector(`#tabs > #${tab.el}`)
                        .classList.remove("hidden");
                } else {
                    document
                        .querySelector(`#tabs > #${tab.el}`)
                        .classList.add("hidden");
                }
            }
        },
        initTab(containerId) {
            const mainTabContainer = document.querySelector(`#${containerId}`);

            mainTabContainer.innerHTML = "";
            mainTabContainer.append(this.tabsTemplate());

            this.changeActiveTab(this.activeTabName);
        },
        tabsTemplate() {
            // The div container
            const tabContainer = document.createElement("div");
            tabContainer.classList.add("border-b", "border-gray-200", "mt-5");

            // The list which will hold all tabs
            const tabList = document.createElement("ul");
            tabList.classList.add(
                "flex",
                "flex-wrap",
                "-mb-px",
                "text-sm",
                "font-medium",
                "text-center",
                "text-gray-500"
            );

            this.tabs.forEach((tab, index) => {
                const tabLi = document.createElement("li");
                tabLi.classList.add("mr-2");
                tabLi.id = `tab-${tab.name}`;

                const tabLink = document.createElement("div");
                tabLink.classList.add(
                    "inline-flex",
                    "p-4",
                    "rounded-t-lg",
                    "border-b-2",
                    "border-transparent",
                    "hover:text-gray-600",
                    "hover:border-gray-300",
                    "group",
                    "cursor-pointer"
                );
                tabLink.setAttribute(
                    "x-on:click",
                    `changeActiveTab('${tab.name}')`
                );

                const tabIcon = document.createElement("i");
                tabIcon.classList.add(
                    "fa-solid",
                    tab.icon,
                    "mr-1",
                    "w-5",
                    "h-5",
                    "text-gray-400",
                    "group-hover:text-gray-500",
                    "transition-all",
                    "!flex",
                    "items-center",
                    "justify-center"
                );

                tabLink.append(tabIcon);
                tabLink.innerHTML += tab.title;

                tabLi.append(tabLink);

                tabList.append(tabLi);
            });

            tabContainer.append(tabList);
            return tabContainer;
        },
    }));
});
