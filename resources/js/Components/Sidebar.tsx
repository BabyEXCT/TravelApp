// components/Sidebar.tsx
import React, { useState } from "react";

type SidebarProps = {
  items: Array<{ name: string; href: string; icon: JSX.Element }>;
};

const Sidebar: React.FC<SidebarProps> = ({ items }) => {
  const [isOpen, setIsOpen] = useState(false);

  return (
    <div className="flex">
      {/* Sidebar */}
      <div
        className={`${
          isOpen ? "w-64" : "w-16"
        } bg-gray-800 h-screen transition-all duration-300 ease-in-out flex flex-col`}
      >
        <div className="flex justify-between items-center p-4">
          <button
            onClick={() => setIsOpen(!isOpen)}
            className="text-white focus:outline-none"
          >
            {isOpen ? "Close" : "Open"}
          </button>
        </div>

        {/* Sidebar items */}
        <ul className="flex-1 mt-4">
          {items.map((item, index) => (
            <li key={index} className="text-gray-300 hover:bg-gray-700 p-2">
              <a href={item.href} className="flex items-center">
                <span className="mr-3">{item.icon}</span>
                {isOpen && <span>{item.name}</span>}
              </a>
            </li>
          ))}
        </ul>
      </div>

      {/* Main content */}
      <div className="flex-1 bg-gray-100 p-8">
        <h1 className="text-2xl font-bold">Main Content</h1>
        {/* Add your main content here */}
      </div>
    </div>
  );
};

export default Sidebar;
